import "package:dio/dio.dart";

import "../models/newsmodel.dart";

class NewsDio {
  late Dio dio;
  final String baseUrl = "http://192.168.100.104:8000/api";
  //final String baseUrl = "http://192.168.100.104:8000/api";
  NewsDio() {
    dio = Dio();
  }

  Future<List<NewsModel>> getData() async {
    try {
      final result = await dio.get('$baseUrl/news');
      return (result.data as List)
          .map((e) => NewsModel.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }
}
