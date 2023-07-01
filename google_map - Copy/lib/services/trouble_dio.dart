import 'dart:io';

import 'package:dio/dio.dart';
import 'package:google_map/models/dokumentrouble.dart';
import 'package:google_map/models/trouble.dart';

class TroubleDio {
  late Dio dio;
  final String baseUrl = "https://satriapirantiperkasa.com/api";
  TroubleDio() {
    dio = Dio();
  }

  Future<List<Trouble>> listoftrouble(int idsitename) async {
    try {
      final result = await dio.get('$baseUrl/listoftrouble/$idsitename');
      return (result.data as List)
          .map((e) => Trouble.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Trouble>> gettrouble(int id) async {
    try {
      final result = await dio.get('$baseUrl/gettrouble/$id');
      return (result.data as List)
          .map((e) => Trouble.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<void> postData(Map<String, dynamic> item) async {
    try {
      await dio.post("$baseUrl/trouble/store", data: item);
    } catch (e) {
      throw Exception(e);
    }
  }

  Future uploadfoto(File file, int idtrouble, String keterangan) async {
    String fileName = file.path.split('/').last;
    String namafile = "";
    FormData formData = FormData.fromMap({
      "image": await MultipartFile.fromFile(
        file.path,
        filename: fileName,
      ),
      "idtrouble": idtrouble,
      "keterangan": keterangan,
      "transaksi": "trouble"
    });
    try {
      await dio
          .post(
            "$baseUrl/apimedia",
            data: formData,
          )
          .then((value) => namafile = value.data);

      return namafile;
    } catch (e) {
      throw Exception(e);
    }
  }

  Future<List<Dokumentrouble>> listdokumen(int idtrouble) async {
    try {
      final result = await dio.get('$baseUrl/trouble/listdokumen/$idtrouble');
      return (result.data as List)
          .map((e) => Dokumentrouble.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }
}
