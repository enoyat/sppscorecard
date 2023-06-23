import "package:dio/dio.dart";

import "../models/chat.dart";

class ChatDio {
  late Dio dio;
  final String baseUrl = "http://192.168.100.104:8000/api";
  ChatDio() {
    dio = Dio();
  }

  Future<void> add(Chat item) async {
    try {
      await dio.post(
        "$baseUrl/chat/add",
        data: item.toMap(),
      );
    } catch (e) {
      throw Exception(e);
    }
  }
}
