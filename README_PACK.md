# PocketMine MenuSystem - Özel Resource Pack

## 📦 Pack Özellikleri

Bu resource pack, PocketMine MenuSystem plugin'i için özel olarak tasarlanmıştır.

### Özellikler:
- ✅ Özel UI Tasarımı
- ✅ Renkli Menü Arayüzü
- ✅ Yapılacak Listesi Görünümü
- ✅ Modern Buton Tasarımları
- ✅ Türkçe Yazı Desteği

## 📥 Kurulum

### Adım 1: Pack Dosyasını Hazırlama
```bash
cd pack/
zip -r MenuSystem.mcpack *
```

### Adım 2: Pack'i Sunucuya Eklemek
1. `MenuSystem.mcpack` dosyasını oluşturun
2. Minecraft'ı açın
3. Ayarlar → Kaynak Paketleri → Paket Ekle
4. `MenuSystem.mcpack` seçin

### Adım 3: Etkinleştirme
1. MenuSystem paketini seçin
2. Oyna → Dünya Oluştur
3. Ayarlar → Kaynak Paketleri → MenuSystem'i etkinleştirin

## 🎨 UI Dosyaları

### `ui/menu_ui.json`
Ana menü ve alt menüler için UI tanımlamaları

### `textures/menu_texture_mapping.json`
Doku eşlemeleri ve görünüm ayarları

### `fonts/default.json`
Yazı tipi ayarları ve renk desteği

## 🔧 Özelleştirme

### Menü Renklerini Değiştirme
`menus/*.json` dosyalarındaki renk kodlarını düzenleyin:
- `§0` - Siyah
- `§a` - Yeşil
- `§b` - Camgöbeği
- `§c` - Kırmızı
- `§e` - Sarı
- `§l` - Kalın

### Buton Tasarımını Değiştirme
`ui/menu_ui.json`'daki buton boyutlarını değiştirin:
```json
"size": ["100%", 40]  // Yükseklik: 40
```

## 📋 Dosya Yapısı

```
pack/
├── manifest.json           # Pack Tanımı
├── pack_icon.png          # Pack İkonu
├── ui/
│   └── menu_ui.json       # UI Tasarımları
├── textures/
│   └── menu_texture_mapping.json
├── fonts/
│   └── default.json
└── animations/
    └── menu_animations.json
```

## 🎯 Uyumluluk

- **PocketMine-MP**: 4.0+
- **Minecraft**: 1.19+
- **Platform**: Windows, macOS, Linux, Bedrock

## 📝 Lisans

MIT - Özgürce kullanabilirsiniz

## 👨‍💻 Katkıda Bulunun

UI iyileştirmeleri ve yeni tasarımlar için pull request gönderin!
