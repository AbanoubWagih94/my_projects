import 'dart:math';

import 'package:flutter/material.dart';

void main() => runApp(MyApp());

class MyApp extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return _MyApp();
  }
}

class _MyApp extends State<MyApp> {
  int leftDice = 1;
  int rightDice = 1;

  void changeDice() {
    setState(() {
      leftDice = Random().nextInt(6) + 1;
      rightDice = Random().nextInt(6) + 1;
    });
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      theme: ThemeData(),
      home: Scaffold(
        backgroundColor: Colors.red,
        appBar: AppBar(
          title: Center(child: Text('Dicee')),
          backgroundColor: Colors.red,
        ),
        body: Container(
          child: Center(
            child: Row(children: <Widget>[
              Expanded(
                child: FlatButton(
                  child: Image.asset('images/dice$leftDice.png'),
                  onPressed: changeDice,
                ),
              ),
              Expanded(
                child: FlatButton(
                  child: Image.asset('images/dice$rightDice.png'),
                  onPressed: changeDice,
                ),
              ),
            ]),
          ),
        ),
      ),
    );
  }
}
