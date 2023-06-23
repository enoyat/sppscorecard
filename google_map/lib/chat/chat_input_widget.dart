import 'package:flutter/material.dart';
import '../models/chat.dart';
import '../services/chat_dio.dart';

class ChatInputWidget extends StatefulWidget {
  const ChatInputWidget({
    Key? key,
    required this.userid,
  }) : super(key: key);
  final int userid;

  @override
  State<ChatInputWidget> createState() => _ChatInputWidgetState();
}

class _ChatInputWidgetState extends State<ChatInputWidget> {
  final TextEditingController textcontroller = TextEditingController();
  var enteredMessage = "";

  void _sendMessage() async {
    FocusScope.of(context).unfocus();
    enteredMessage = textcontroller.text;
    final Chat chat = Chat(
      userid: widget.userid,
      message: enteredMessage,
      status: 'unread',
      type: "1",
    );
    await ChatDio().add(chat);
    setState(() {
      textcontroller.clear();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(top: 8),
      padding: const EdgeInsets.all(8),
      child: Row(
        children: [
          Expanded(
            child: TextField(
              controller: textcontroller,
              decoration: const InputDecoration(
                labelText: "kirim pesan",
                border: OutlineInputBorder(),
              ),
              onChanged: (value) {
                setState(() {
                  enteredMessage = value;
                });
              },
            ),
          ),
          IconButton(
            onPressed: enteredMessage.trim().isEmpty ? null : _sendMessage,
            icon: const Icon(Icons.send),
          ),
        ],
      ),
    );
  }
}
