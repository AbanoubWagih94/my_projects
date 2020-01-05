import 'package:flutter/material.dart';

final ThemeData _androidTheme = ThemeData(
    brightness: Brightness.light,
    primarySwatch: Colors.grey,
    accentColor: Colors.blue,
    fontFamily: '0swald',
    buttonColor: Colors.blue);

final ThemeData _iOSTheme = ThemeData(
    brightness: Brightness.light,
    primarySwatch: Colors.deepOrange,
    accentColor: Colors.deepPurple,
    fontFamily: '0swald',
    buttonColor: Colors.deepPurple);

ThemeData getAdaptiveThemeData(context) {
  return Theme.of(context).platform == TargetPlatform.iOS
      ? _iOSTheme
      : _androidTheme;
}
