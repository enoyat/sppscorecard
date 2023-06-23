// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';

class BubbleWidget extends StatelessWidget {
  const BubbleWidget({
    Key? key,
    required this.message,
    required this.username,
    required this.isMe,
  }) : super(key: key);
  final String message;
  final String username;
  final bool isMe;

  @override
  Widget build(BuildContext context) {
    return Stack(
      clipBehavior: Clip.none,
      children: [
        Row(
          mainAxisAlignment:
              isMe ? MainAxisAlignment.end : MainAxisAlignment.start,
          children: [
            Container(
              decoration: BoxDecoration(
                color: isMe ? Colors.grey[300] : Colors.grey[500],
                borderRadius: BorderRadius.only(
                  topLeft: const Radius.circular(12),
                  topRight: const Radius.circular(12),
                  bottomLeft: !isMe
                      ? const Radius.circular(0)
                      : const Radius.circular(12),
                  bottomRight: isMe
                      ? const Radius.circular(0)
                      : const Radius.circular(12),
                ),
              ),
              width: 140,
              padding: const EdgeInsets.symmetric(
                vertical: 10,
                horizontal: 16,
              ),
              margin: const EdgeInsets.symmetric(
                vertical: 16,
                horizontal: 8,
              ),
              child: Column(
                crossAxisAlignment:
                    isMe ? CrossAxisAlignment.end : CrossAxisAlignment.start,
                children: [
                  Text(
                    username,
                    style: const TextStyle(
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  Text(
                    message,
                    style: const TextStyle(
                      color: Colors.black87,
                    ),
                    textAlign: isMe ? TextAlign.end : TextAlign.start,
                  ),
                ],
              ),
            )
          ],
        ),
        Positioned(
          top: 0,
          left: isMe ? null : 120,
          right: isMe ? 120 : null,
          child: const CircleAvatar(
            backgroundImage: NetworkImage(
                'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png'),
          ),
        ),
      ],
    );
  }
}
