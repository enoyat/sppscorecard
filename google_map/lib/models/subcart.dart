import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class SubCart {
  final int? id;
  final int userid;
  final int wastetypeid;
  final int wastesubtypeid;
  SubCart({
    this.id,
    required this.userid,
    required this.wastetypeid,
    required this.wastesubtypeid,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'userid': userid,
      'wastetypeid': wastetypeid,
      'wastesubtypeid': wastesubtypeid,
    };
  }

  factory SubCart.fromMap(Map<String, dynamic> map) {
    return SubCart(
      id: map['id'] != null ? map['id'] as int : null,
      userid: map['userid'] as int,
      wastetypeid: map['wastetypeid'] as int,
      wastesubtypeid: map['wastesubtypeid'] as int,
    );
  }

  String toJson() => json.encode(toMap());

  factory SubCart.fromJson(String source) =>
      SubCart.fromMap(json.decode(source) as Map<String, dynamic>);

  SubCart copyWith({
    int? id,
    int? userid,
    int? wastetypeid,
    int? wastesubtypeid,
  }) {
    return SubCart(
      id: id ?? this.id,
      userid: userid ?? this.userid,
      wastetypeid: wastetypeid ?? this.wastetypeid,
      wastesubtypeid: wastesubtypeid ?? this.wastesubtypeid,
    );
  }

  @override
  String toString() {
    return 'SubCart(id: $id, userid: $userid, wastetypeid: $wastetypeid, wastesubtypeid: $wastesubtypeid)';
  }
}
