import 'package:flutter/material.dart';

class Task {
  final String taskTitle;
  bool isDone = false;

  Task({@required this.taskTitle});

  void toggleDone() {
    isDone = !isDone;
  }
}
