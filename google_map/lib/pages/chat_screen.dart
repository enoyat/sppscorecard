// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';

import 'package:google_map/chat/message_widget.dart';
import 'package:google_map/pages/dashboard_page.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../chat/chat_input_widget.dart';
import 'login.dart';

class ChatPage extends StatefulWidget {
  const ChatPage({
    Key? key,
    required this.userid,
  }) : super(key: key);

  final int userid;

  @override
  State<ChatPage> createState() => _ChatPageState();
}

class _ChatPageState extends State<ChatPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: const Text("Chat"),
          actions: [
            IconButton(
              onPressed: () {
                Navigator.pushReplacement(context,
                    MaterialPageRoute(builder: (context) {
                  return DashboardPage(
                    userid: widget.userid,
                  );
                }));
              },
              icon: const Icon(Icons.home),
            ),
            IconButton(
              onPressed: () async {
                SharedPreferences preferences =
                    await SharedPreferences.getInstance();
                await preferences.clear();
                if (!mounted) return;
                Navigator.pushReplacement(context,
                    MaterialPageRoute(builder: (context) {
                  return const LoginPage();
                }));
              },
              icon: const Icon(Icons.logout),
            ),
          ],
        ),
        body: Center(
          child: Column(
            children: [
              Expanded(
                child: MessageWidget(
                  userid: widget.userid,
                ),
              ),
              ChatInputWidget(
                userid: widget.userid,
              ),
            ],
          ),
        ));
  }
}
