import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class Deposit {
  final int? id;
  final int saldo;
  final int point;
  Deposit({
    this.id,
    required this.saldo,
    required this.point,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'saldo': saldo,
      'point': point,
    };
  }

  factory Deposit.fromMap(Map<String, dynamic> map) {
    return Deposit(
      id: map['id'] != null ? map['id'] as int : null,
      saldo: map['saldo'] as int,
      point: map['point'] as int,
    );
  }

  String toJson() => json.encode(toMap());

  factory Deposit.fromJson(String source) =>
      Deposit.fromMap(json.decode(source) as Map<String, dynamic>);

  Deposit copyWith({
    int? id,
    int? saldo,
    int? point,
  }) {
    return Deposit(
      id: id ?? this.id,
      saldo: saldo ?? this.saldo,
      point: point ?? this.point,
    );
  }

  @override
  String toString() => 'Deposit(id: $id, saldo: $saldo, point: $point)';
}
