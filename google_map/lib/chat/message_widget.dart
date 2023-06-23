import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:google_map/chat/bubble_widget.dart';

import '../models/chat.dart';

class MessageWidget extends StatefulWidget {
  const MessageWidget({
    Key? key,
    required this.userid,
  }) : super(key: key);
  final int userid;

  @override
  State<MessageWidget> createState() => _MessageWidgetState();
}

class _MessageWidgetState extends State<MessageWidget> {
  List<Chat> _listmessage = [];
  Dio dio = Dio();

  Stream listmessages() async* {
    yield* Stream.periodic(const Duration(seconds: 5), (_) {
      return dio.get(
          "http://salin.sikocloudtech.or.id/api/chat/getchat?userid=${widget.userid}");
    }).asyncMap((event) async => await event);
  }

  final ScrollController scrollController = ScrollController();
  subScroll() {
    scrollController.animateTo(scrollController.position.maxScrollExtent,
        duration: const Duration(milliseconds: 10), curve: Curves.easeOut);
  }

  @override
  Widget build(BuildContext context) {
    return StreamBuilder(
        stream: listmessages(),
        builder: (context, snapshot) {
          if (snapshot.hasError) {
            return const Text('');
          }
          if (snapshot.hasData) {
            Response response = snapshot.data as Response;
            _listmessage = (response.data as List)
                .map((e) => Chat.fromMap(e as Map<String, dynamic>))
                .toList();
            return ListView.builder(
                itemCount: _listmessage.length,
                controller: scrollController,
                shrinkWrap: true,
                itemBuilder: (context, index) {
                  subScroll();
                  return BubbleWidget(
                    message: _listmessage[index].message,
                    username: _listmessage[index].type == "1" ? "Me" : "Admin",
                    isMe: _listmessage[index].type == "1" ? true : false,
                  );
                });
          } else {
            return const Center(
              child: CircularProgressIndicator(),
            );
          }
        });
  }
}
