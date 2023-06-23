import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class CartWasteSubType {
  final int? id;
  final String name;
  final int? harga;
  final int? incartid;
  CartWasteSubType({
    this.id,
    required this.name,
    this.harga,
    this.incartid,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'name': name,
      'harga': harga,
      'incartid': incartid,
    };
  }

  factory CartWasteSubType.fromMap(Map<String, dynamic> map) {
    return CartWasteSubType(
      id: map['id'] != null ? map['id'] as int : null,
      name: map['name'] as String,
      harga: map['harga'] != null ? map['harga'] as int : null,
      incartid: map['incartid'] != null ? map['incartid'] as int : null,
    );
  }

  String toJson() => json.encode(toMap());

  factory CartWasteSubType.fromJson(String source) =>
      CartWasteSubType.fromMap(json.decode(source) as Map<String, dynamic>);

  CartWasteSubType copyWith({
    int? id,
    String? name,
    int? harga,
    int? incartid,
  }) {
    return CartWasteSubType(
      id: id ?? this.id,
      name: name ?? this.name,
      harga: harga ?? this.harga,
      incartid: incartid ?? this.incartid,
    );
  }

  @override
  String toString() {
    return 'CartWasteSubType(id: $id, name: $name, harga: $harga, incartid: $incartid)';
  }
}
