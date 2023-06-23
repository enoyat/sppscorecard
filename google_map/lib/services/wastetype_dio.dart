// ignore_for_file: public_member_api_docs, sort_constructors_first, empty_catches
import "package:dio/dio.dart";
import '../models/wastesubtype.dart';
import '../models/wastetype.dart';

class WasteTypeDio {
  late Dio dio;
  final String baseUrl = "http://192.168.100.104:8000/api";
  WasteTypeDio() {
    dio = Dio();
  }

  Future<List<WasteType>> getData() async {
    try {
      final result = await dio.get('$baseUrl/wastetype');
      return (result.data as List)
          .map((e) => WasteType.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<WasteSubType>> getSubData(int id) async {
    try {
      final result = await dio.get('$baseUrl/getwastesubtype/$id');
      return (result.data as List)
          .map((e) => WasteSubType.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<WasteType> postData(WasteType item) async {
    return await dio
        .post(
          "$baseUrl/wastetype",
          data: item.toMap(),
        )
        .then((value) => WasteType.fromMap(value.data as Map<String, dynamic>));
  }

  Future<WasteType> updateData(WasteType item) async {
    final result = await dio.put(
      "$baseUrl/wastetype/${item.id}",
      data: item.toMap(),
    );
    return WasteType.fromMap(result.data as Map<String, dynamic>);
  }

  Future<void> deleteData(WasteType item) async {
    try {
      final result = await dio.delete(
        "$baseUrl/wastetype/${item.id}",
      );
      return result.data;
    } catch (e) {}
  }
}
