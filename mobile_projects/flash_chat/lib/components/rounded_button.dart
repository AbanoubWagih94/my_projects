import 'package:flutter/material.dart';

class RoundedButton extends StatelessWidget {
  final Color color;
  final String title;
  final Function onPressed;

  RoundedButton({this.color, this.title, @required this.onPressed});

  @override
  Widget build(BuildContext context) {
    return Material(
      elevation: 5.0,
      borderRadius: BorderRadius.circular(30.0),
      color: color,
      textStyle: TextStyle(color: Colors.white),
      child: MaterialButton(
          padding: EdgeInsets.symmetric(vertical: 16.0),
          minWidth: 500.0,
          height: 45.0,
          child: Text('$title'),
          onPressed: onPressed),
    );
  }
}
