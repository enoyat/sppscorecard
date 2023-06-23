import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class Cart {
  final int id;
  final String name;
  final String details;
  final int? idcart;
  final int? wastetypeid;
  late final int? berat;
  final int? userid;
  Cart({
    required this.id,
    required this.name,
    required this.details,
    this.idcart,
    this.wastetypeid,
    this.berat,
    this.userid,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'name': name,
      'details': details,
      'idcart': idcart,
      'wastetypeid': wastetypeid,
      'berat': berat,
      'userid': userid,
    };
  }

  factory Cart.fromMap(Map<String, dynamic> map) {
    return Cart(
      id: map['id'] as int,
      name: map['name'] as String,
      details: map['details'] as String,
      idcart: map['idcart'] != null ? map['idcart'] as int : null,
      wastetypeid:
          map['wastetypeid'] != null ? map['wastetypeid'] as int : null,
      berat: map['berat'] != null ? map['berat'] as int : null,
      userid: map['userid'] != null ? map['userid'] as int : null,
    );
  }

  String toJson() => json.encode(toMap());

  factory Cart.fromJson(String source) =>
      Cart.fromMap(json.decode(source) as Map<String, dynamic>);

  @override
  String toString() {
    return 'Cart(id: $id, name: $name, details: $details, idcart: $idcart, wastetypeid: $wastetypeid, berat: $berat, userid: $userid)';
  }

  Cart copyWith({
    int? id,
    String? name,
    String? details,
    int? idcart,
    int? wastetypeid,
    int? berat,
    int? userid,
  }) {
    return Cart(
      id: id ?? this.id,
      name: name ?? this.name,
      details: details ?? this.details,
      idcart: idcart ?? this.idcart,
      wastetypeid: wastetypeid ?? this.wastetypeid,
      berat: berat ?? this.berat,
      userid: userid ?? this.userid,
    );
  }
}
