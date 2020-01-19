import 'package:flutter/material.dart';
import 'quiz_bank.dart';
import 'package:rflutter_alert/rflutter_alert.dart';

QuizBank questionBank = QuizBank();
void main() => runApp(Quizzler());

class Quizzler extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return _Quizzler();
  }
}

class _Quizzler extends State<Quizzler> {
  List<Icon> scoreKeeper= [];

  AlertStyle alertStyle = AlertStyle(
    animationType: AnimationType.fromBottom,
    isCloseButton: true,
    isOverlayTapDismiss: false,
    descStyle: TextStyle(fontWeight: FontWeight.bold),
      animationDuration: Duration(milliseconds: 400),
      alertBorder: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(0.0),
        side: BorderSide(
          color: Colors.grey,
        ),
      ),
      titleStyle: TextStyle(
        color: Colors.red,
      ),
  );


  void checkAnswer(bool answer) {
    bool corrextAnswer = questionBank.getQuestionAnswer();

  
    setState(() {
     if(questionBank.isFinished() == true){
       Alert(
         context: context,
         type: AlertType.info,
         title: "RFLUTTER ALERT",
         desc: "Flutter is more awesome with RFlutter Alert."
       ).show();

       questionBank.reset();
       scoreKeeper = [];
     } else {
       if ( answer == corrextAnswer){
       scoreKeeper.add(Icon(Icons.check, color:Colors.green));
     } else {
       scoreKeeper.add(Icon(Icons.close, color:Colors.red));
     }
      questionBank.nextQuestion();
     }
     
    });
  }
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        backgroundColor: Colors.grey.shade900,
        body: SafeArea(
          child: Padding(
              padding: EdgeInsets.symmetric(horizontal: 10.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.stretch,
                children: <Widget>[
                  Expanded(
                    flex: 5,
                    child: Padding(
                        padding: EdgeInsets.all(10.0),
                        child: Center(
                          child: Text(
                            questionBank.getQuestionText(),
                            style:
                                TextStyle(color: Colors.white, fontSize: 25.0),
                            textAlign: TextAlign.center,
                          ),
                        )),
                  ),
                  Expanded(
                    child: Padding(
                      padding: EdgeInsets.all(15.0),
                      child: FlatButton(
                        color: Colors.green,
                        child: Text(
                          'True',
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 20.0,
                          ),
                        ),
                        onPressed: () {
                          checkAnswer(true);
                        },
                      ),
                    ),
                  ),
                  Expanded(
                    child: Padding(
                      padding: EdgeInsets.all(15.0),
                      child: FlatButton(
                        color: Colors.red,
                        child: Text(
                          'Flase',
                          style: TextStyle(
                            fontSize: 20.0,
                            color: Colors.white,
                          ),
                        ),
                        onPressed: () {
                          checkAnswer(false);                       },
                      ),
                    ),
                  ),
                  Row(
                    children: scoreKeeper,
                  )
                ],
              )),
        ),
      ),
    );
  }
}
