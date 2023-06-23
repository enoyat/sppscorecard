import "package:dio/dio.dart";
import "package:google_map/models/addsmodel.dart";

class AddsDio {
  late Dio dio;
  final String baseUrl = "http://192.168.100.104:8000/api";
  AddsDio() {
    dio = Dio();
  }

  Future<List<AddsModel>> getData() async {
    try {
      final result = await dio.get('$baseUrl/adds');
      return (result.data as List)
          .map((e) => AddsModel.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }
}
