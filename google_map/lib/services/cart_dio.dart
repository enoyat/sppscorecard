// ignore_for_file: public_member_api_docs, sort_constructors_first, empty_catches
import "package:dio/dio.dart";
import 'package:google_map/models/cart_wastetype.dart';
import '../../models/cart.dart';
import '../../models/cart_wastesubtype.dart';
import '../../models/subcart.dart';
import '../models/itemcart.dart';
import '../models/itemsubcart.dart';

class CartDio {
  late Dio dio;
  final String baseUrl = "http://192.168.100.104:8000/api";
  CartDio() {
    dio = Dio();
  }

  Future<List<Cart>> getCart(int userid) async {
    try {
      final result = await dio.get('$baseUrl/getcart?userid=$userid');
      return (result.data as List)
          .map((e) => Cart.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<CartWasteSubType>> getSubCart(int userid, int id) async {
    try {
      //http://salin.sikocloudtech.or.id/api/getsubcart?userid=1&id=3
      final result = await dio.get('$baseUrl/getsubcart?userid=$userid&id=$id');
      return (result.data as List)
          .map((e) => CartWasteSubType.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<CartWasteType> postData(CartWasteType item) async {
    try {
      return await dio
          .post(
            "$baseUrl/cart",
            data: item.toMap(),
          )
          .then((value) =>
              CartWasteType.fromMap(value.data as Map<String, dynamic>));
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  hapussubcart(Map item) async {
    try {
      return await dio.post("$baseUrl/hapussubcart", data: item);
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<SubCart> subcartstore(SubCart item) async {
    try {
      return await dio
          .post(
            "$baseUrl/subcartstore",
            data: item.toMap(),
          )
          .then((value) => SubCart.fromMap(value.data as Map<String, dynamic>));
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<CartWasteType> updateData(CartWasteType item) async {
    final result = await dio.put(
      "$baseUrl/cart/${item.id}",
      data: item.toMap(),
    );
    return CartWasteType.fromMap(result.data as Map<String, dynamic>);
  }

  Future<void> deleteData(Cart item) async {
    try {
      final result = await dio.delete(
        "$baseUrl/cart/${item.idcart}",
      );
      return result.data;
    } catch (e) {}
  }

  Future<List<ItemCart>> itemcart(int userid) async {
    try {
      final result = await dio.get('$baseUrl/itemcart?userid=$userid');
      return (result.data as List)
          .map((e) => ItemCart.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<ItemSubCart>> itemsubcart(int userid, int wastetypeid) async {
    try {
      final result = await dio
          .get('$baseUrl/itemsubcart?userid=$userid&wastetypeid=$wastetypeid');
      return (result.data as List)
          .map((e) => ItemSubCart.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }
}
