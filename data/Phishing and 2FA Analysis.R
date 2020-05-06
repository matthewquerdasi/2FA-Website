# Matt Querdasi & Sam Driver
# Phishing and 2FA Survey Analysis

require(ggplot2)
require(dplyr)
require(reshape2)
require(shiny)
require(formattable)

# import dataset
Phishing_2FA <- read.csv("~/Documents/Junior Year/Spring/Information Security and Privacy/Phishing_2FA.csv", na.strings=c("", "NA"))

# renaming
names(Phishing_2FA) <- c("timestamp", "consent", "knowledge_phish", "descr_phish", "knowledge_2FA", "descr_2FA", "wes_login", "amaz_login", "wescam_login", "netflix_login", "infavor_wes2FA", "cybersec_importance", "cybersec_onmind", "cybersec_frightened", "cyberattack_victim")

# data manipulation
Phishing_2FA %>% 
  # coding question answers in as correct or incorrect 
  mutate(wes_login=as.factor(ifelse(wes_login=="No", "Correct", "Incorrect")),
         amaz_login=as.factor(ifelse(amaz_login=="Yes", "Correct", "Incorrect")),
         wescam_login=as.factor(ifelse(wescam_login=="No", "Correct", "Incorrect")),
         netflix_login=as.factor(ifelse(netflix_login=="Yes", "Correct", "Incorrect")),
         
         # calculating total correct answer variable 
         percentCorrect=0,
         percentCorrect=ifelse(wes_login=="Correct", percentCorrect+0.25, percentCorrect),
         percentCorrect=ifelse(amaz_login=="Correct", percentCorrect+0.25, percentCorrect),
         percentCorrect=ifelse(wescam_login=="Correct", percentCorrect+0.25, percentCorrect),
         percentCorrect=ifelse(netflix_login=="Correct", percentCorrect+0.25, percentCorrect)) -> Phishing_2FA



# SHINY WITH BAR CHART
# simple SHINY to see how many knew phishing, 2fa and how many victims
ui<-fluidPage(
  # yes/no graph
  selectInput(inputId="variable1",
              label="Choose a question to display",
              choices=c("Do you know what a phishing attack is?", 
                        "Do you know what two-factor authentication is?", 
                        "Have you been the victim of a cyber attack?")
  ),
  plotOutput(outputId="barchart"),
  # 
  selectInput(inputId="variable2",
              label="Choose a question to display on the y axis",
              choices=c("How important is cyber security to you?", 
                        "How often do you think about cyber security?", 
                        "How frightened are you of being the victim of a cyber attack?")
  ),
  plotOutput(outputId="bargraph")
)

server<-function(input, output){
  output$barchart<-renderPlot({
    
    # removing the missing values
    Phishing_2FA %>% 
      filter(cyberattack_victim=="Yes" | cyberattack_victim=="No" ) %>% 
      mutate("Do you know what a phishing attack is?"=knowledge_phish,
             "Do you know what two-factor authentication is?"=knowledge_2FA,
             "Have you been the victim of a cyber attack?"=cyberattack_victim) -> temp_data1
    
    ggplot(data=temp_data1, aes(x=eval(as.symbol(input$variable1)), y=..prop.., group=1, fill=factor(..x..)))+
      geom_bar()+
      scale_y_continuous(labels = scales::percent_format())+
      geom_text(aes(label=percent(..prop..)), stat='count', 
                nudge_y=0.03, va='bottom', format_string='{:.1f}')+
      xlab(eval(as.character(input$variable1)))+
      ylab("Percent of Responses")+
      ggtitle("Survey Results ")+
      scale_fill_manual("Response", labels=c("No", "Yes"), values=c("red2", "lawngreen"))
  })
  
  output$bargraph<-renderPlot({
    # making percentCorrect into factor for coloring and setting nas to average 50%
    Phishing_2FA %>% 
      mutate(percentCorrect=as.character(percentCorrect),
             percentCorrect=ifelse(is.na(percentCorrect), 0.5, percentCorrect),
             percentCorrect=as.factor(percentCorrect),
             
             "How important is cyber security to you?"=cybersec_importance,
             "How often do you think about cyber security?"=cybersec_onmind,
             "How frightened are you of being the victim of a cyber attack?"=cybersec_frightened) -> temp_data2
    
    ggplot(data=temp_data2)+
      stat_summary(aes(x=percentCorrect, y=eval(as.symbol(input$variable2)), 
                       fill=percentCorrect, na.rm=TRUE), fun.y="mean", geom="bar")+
      ggtitle("Survey Results")+
      xlab("Questions Answered Correctly (%)")+
      ylab("Average Response (1-mild, 10-extreme)")+
      scale_fill_brewer("Correct Answers (%)", palette="YlGnBu")
    
    
  })
}

shinyApp(ui=ui, server=server)



# FACETED STATIC GRAPH 
# collapsing data set to then facet
Phishing_collapsed <- Phishing_2FA[,c(3,5,11,15,16)]

# going from wide to long 
Phishing_melted <- melt(Phishing_collapsed, id="percentCorrect")

# making yes no answers factors 
Phishing_melted %>% 
  mutate(value=as.character(value),
         value=ifelse(is.na(value), "No", value)) -> Phishing_melted

# creating labels for facet graph 
variable.labs <- c("Know what phishing attack is", "Know what 2FA is", "In favor of 2FA at Wesleyan", "Been a cyberattack victim")
names(variable.labs) <- c("knowledge_phish", "knowledge_2FA", "infavor_wes2FA", "cyberattack_victim")

# bar graph faceted 
ggplot(data=Phishing_melted)+
  stat_summary(aes(x=value, y=percentCorrect, fill=value), geom="bar", fun.y="mean")+
  facet_grid(.~variable, labeller=labeller(variable=variable.labs))+
  xlab("Survey Question")+
  ylab("Average Correct Answers (%)")+
  #ggtitle("Percent of Correct Responses by Question Type and Response")+
  scale_fill_manual("Reponse", values=c("red2","lawngreen"))
  
  





