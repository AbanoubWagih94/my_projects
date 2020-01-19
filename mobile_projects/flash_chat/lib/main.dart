import 'package:flutter/material.dart';

import './screens/welcome.dart';
import './screens/login.dart';
import './screens/registration.dart';
import './screens/chat.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      theme: ThemeData.dark().copyWith(
        scaffoldBackgroundColor: Colors.white,
      ),
      routes: <String, WidgetBuilder>{
        '/': (BuildContext context) => WelcomeScreen(),
        '/login_screen': (BuildContext context) => LoginScreen(),
        '/register_screen': (BuildContext context) => RegisterScreen(),
        '/chat_screen': (BuildContext context) => ChatScreen()
      },
    );
  }
}
