import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class ItemSubCart {
  final int id;
  final int wastetypeid;
  final int wastesubtypeid;
  final String name;
  ItemSubCart({
    required this.id,
    required this.wastetypeid,
    required this.wastesubtypeid,
    required this.name,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'wastetypeid': wastetypeid,
      'wastesubtypeid': wastesubtypeid,
      'name': name,
    };
  }

  factory ItemSubCart.fromMap(Map<String, dynamic> map) {
    return ItemSubCart(
      id: map['id'] as int,
      wastetypeid: map['wastetypeid'] as int,
      wastesubtypeid: map['wastesubtypeid'] as int,
      name: map['name'] as String,
    );
  }

  String toJson() => json.encode(toMap());

  factory ItemSubCart.fromJson(String source) =>
      ItemSubCart.fromMap(json.decode(source) as Map<String, dynamic>);

  ItemSubCart copyWith({
    int? id,
    int? wastetypeid,
    int? wastesubtypeid,
    String? name,
  }) {
    return ItemSubCart(
      id: id ?? this.id,
      wastetypeid: wastetypeid ?? this.wastetypeid,
      wastesubtypeid: wastesubtypeid ?? this.wastesubtypeid,
      name: name ?? this.name,
    );
  }

  @override
  String toString() {
    return 'ItemSubCart(id: $id, wastetypeid: $wastetypeid, wastesubtypeid: $wastesubtypeid, name: $name)';
  }
}
