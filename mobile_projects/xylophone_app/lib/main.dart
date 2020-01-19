import 'package:flutter/material.dart';
import 'package:audioplayers/audio_cache.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  
  Widget buildKey({int soundNum, Color color}) {
    return Expanded(
      child: FlatButton(
        color: color,
        child: Text(''),
        onPressed: (){
          final player = AudioCache();
          player.play('note$soundNum.wav');
        },
      ),
    );
  }
  
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        body: SafeArea(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: <Widget>[
              buildKey(color: Colors.red, soundNum:1),
              buildKey(color: Colors.orange, soundNum:2),
              buildKey(color: Colors.yellow, soundNum:3),
              buildKey(color: Colors.green, soundNum:4),
              buildKey(color: Colors.teal, soundNum:5),
              buildKey(color: Colors.blue, soundNum:6),
              buildKey(color: Colors.purple, soundNum:7),
            ],
          ),
        ),

      ),   
    );
  }
}
