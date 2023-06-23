import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class CartWasteType {
  final int? id;
  final int wastetypeid;
  final int berat;
  final int userid;
  final int? hargamin;
  final int? hargamax;
  final String? status;
  CartWasteType({
    this.id,
    required this.wastetypeid,
    required this.berat,
    required this.userid,
    this.hargamin,
    this.hargamax,
    this.status,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'wastetypeid': wastetypeid,
      'berat': berat,
      'userid': userid,
      'hargamin': hargamin,
      'hargamax': hargamax,
      'status': status,
    };
  }

  factory CartWasteType.fromMap(Map<String, dynamic> map) {
    return CartWasteType(
      id: map['id'] != null ? map['id'] as int : null,
      wastetypeid: map['wastetypeid'] as int,
      berat: map['berat'] as int,
      userid: map['userid'] as int,
      hargamin: map['hargamin'] != null ? map['hargamin'] as int : null,
      hargamax: map['hargamax'] != null ? map['hargamax'] as int : null,
      status: map['status'] != null ? map['status'] as String : null,
    );
  }

  String toJson() => json.encode(toMap());

  factory CartWasteType.fromJson(String source) =>
      CartWasteType.fromMap(json.decode(source) as Map<String, dynamic>);

  CartWasteType copyWith({
    int? id,
    int? wastetypeid,
    int? berat,
    int? userid,
    int? hargamin,
    int? hargamax,
    String? status,
  }) {
    return CartWasteType(
      id: id ?? this.id,
      wastetypeid: wastetypeid ?? this.wastetypeid,
      berat: berat ?? this.berat,
      userid: userid ?? this.userid,
      hargamin: hargamin ?? this.hargamin,
      hargamax: hargamax ?? this.hargamax,
      status: status ?? this.status,
    );
  }

  @override
  String toString() {
    return 'CartWasteType(id: $id, wastetypeid: $wastetypeid, berat: $berat, userid: $userid, hargamin: $hargamin, hargamax: $hargamax, status: $status)';
  }
}
