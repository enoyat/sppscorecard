import 'package:dio/dio.dart';
import 'package:google_map/models/invoice.dart';
import 'package:google_map/models/transaction.dart';

import '../models/register.dart';

class TransactionDio {
  late Dio dio;
  final String baseUrl = "http://192.168.100.104:8000/api";
  TransactionDio() {
    dio = Dio();
  }

  Future<void> postData(Transaction item) async {
    try {
      await dio.post(
        "$baseUrl/transaction",
        data: item.toMap(),
      );
    } catch (e) {
      throw Exception(e);
    }
  }

  Future<List<Transaction>> listtransaction(int id, String status) async {
    try {
      final result =
          await dio.get('$baseUrl/listtransaction?id=$id&status=done');
      return (result.data as List)
          .map((e) => Transaction.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Transaction>> listtransactionworker(int id, String status) async {
    try {
      final result = await dio
          .get('$baseUrl/worker/listtransaction?workerid=$id&status=done');
      return (result.data as List)
          .map((e) => Transaction.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Transaction>> gettransaction(int id) async {
    try {
      final result = await dio.get('$baseUrl/gettransaction?id=$id');

      return (result.data as List)
          .map((e) => Transaction.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<void> canceltransaction(int id) async {
    try {
      await dio.get('$baseUrl/canceltransaction?id=$id');
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<void> postInvoice(Invoice item) async {
    try {
      await dio.post(
        "$baseUrl/postinvoice",
        data: item.toMap(),
      );
    } catch (e) {
      throw Exception(e);
    }
  }

  Future register(RegisterModel item) async {
    try {
      return await dio
          .post(
            "$baseUrl/register",
            data: item.toMap(),
          )
          .then((value) => value.data);
    } catch (e) {
      throw Exception(e);
    }
  }
}
