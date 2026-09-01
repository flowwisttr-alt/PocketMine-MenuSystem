# PocketMine-MP Menu Sistemi

## Açıklama
Bu plugin, PocketMine-MP sunucuları için özel JSON tabanlı bir menü sistemi sağlar. Hiçbir form kütüphanesi kullanmaz, tamamen özel menu yapısı ile çalışır.

## Özellikler
- ✅ Tamamen JSON tabanlı menü konfigürasyonu
- ✅ İç içe menüler (Sub-menus)
- ✅ Dinamik buton eylemleri
- ✅ Komut yürütme
- ✅ Mesaj gönderme
- ✅ Teleport sistemi
- ✅ Kolay konfigürasyon

## Kurulum

1. Repository'yi klonlayın veya indirin
2. `src/` klasörünü plugin klasörüne kopyalayın
3. `menus/` klasörünü veri klasörüne kopyalayın
4. Sunucuyu yeniden başlatın

## Komutlar

```
/menu list          - Tüm menüleri listele
/menu open <id>     - Belirli bir menüyü aç
/menu reload        - Menüleri yeniden yükle (OP)
```

## JSON Menü Formatı

```json
{
  "id": "menu_id",
  "title": "§l§6Menü Başlığı",
  "description": "§7Menü açıklaması",
  "buttons": [
    {
      "text": "§aDüğme Metni",
      "action": "command",
      "data": {
        "command": "komut"
      }
    }
  ]
}
```

## Eylem Türleri

### 1. Command (Komut)
```json
{
  "text": "Komutu Çalıştır",
  "action": "command",
  "data": {
    "command": "give @s diamond 64"
  }
}
```

### 2. Message (Mesaj)
```json
{
  "text": "Mesaj Gönder",
  "action": "message",
  "data": {
    "message": "§7Merhaba oyuncu!"
  }
}
```

### 3. Menu (Alt Menü)
```json
{
  "text": "Alt Menüyü Aç",
  "action": "menu",
  "data": {
    "menu_id": "other_menu"
  }
}
```

### 4. Teleport
```json
{
  "text": "Spawn'a Teleport",
  "action": "teleport",
  "data": {
    "x": 0,
    "y": 64,
    "z": 0
  }
}
```

### 5. Give Item (Eşya Ver)
```json
{
  "text": "Elmas Ver",
  "action": "give_item",
  "data": {
    "item_id": 264,
    "amount": 64
  }
}
```

## Renk Kodları

- `§0` - Siyah
- `§1` - Koyu Mavi
- `§2` - Koyu Yeşil
- `§3` - Koyu Camgöbeği
- `§4` - Koyu Kırmızı
- `§5` - Mor
- `§6` - Altın
- `§7` - Gri
- `§8` - Koyu Gri
- `§9` - Mavi
- `§a` - Yeşil
- `§b` - Camgöbeği
- `§c` - Kırmızı
- `§d` - Pembe
- `§e` - Sarı
- `§f` - Beyaz
- `§l` - Kalın
- `§o` - İtalik
- `§n` - Altı Çizili
- `§r` - Sıfırla

## Yeni Menü Oluşturma

`menus/` klasörüne yeni bir JSON dosyası oluşturun:

```bash
touch menus/custom_menu.json
```

Dosya içeriğini düzenleyin ve sunucuyu yeniden başlatın veya `/menu reload` komutunu çalıştırın.

## İzinler

- `menusystem.command` - Menu komutunun temel kullanımı (varsayılan: true)
- `menusystem.reload` - Menüleri yeniden yükleme (varsayılan: OP)

## Geliştirici

flowwisttr-alt

## Lisans

MIT
