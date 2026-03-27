# KuroShops 🛒

A simple, lightweight shop plugin for PocketMine-MP servers powered by SimpleEconomy.

---

## 📋 Requirements

| Dependency | Version |
|---|---|
| PocketMine-MP | API 5.42.0+ |
| PHP | 8.2+ |
| [SimpleEconomy](https://github.com/NhanAZ/SimpleEconomy) | Latest |
| [FormAPI](https://github.com/jojoe77777/FormAPI) | Latest |

---

## 📦 Installation

1. Download and place `KuroShops` into your `/plugins` folder
2. Make sure **SimpleEconomy** and **FormAPI** are also in your `/plugins` folder
3. Restart your server
4. The plugin will load automatically

---

## 🛠️ Commands

| Command | Description | Permission | Default |
|---|---|---|---|
| `/shop` | Opens the KuroShops menu | `kuroshops.shop` | All players |
| `/store` | Alias for `/shop` | `kuroshops.shop` | All players |

---

## 🏪 Shop Categories

### 🌲 Woods
| Item | Price | Quantity |
|---|---|---|
| Oak Wood | $50 | 16x |
| Birch Wood | $60 | 16x |
| Spruce Wood | $70 | 16x |

### 🌾 Crops
| Item | Price | Quantity |
|---|---|---|
| Wheat Seeds | $20 | 16x |
| Carrot | $30 | 16x |
| Potato | $30 | 16x |

### 🍖 Food
| Item | Price | Quantity |
|---|---|---|
| Steak | $80 | 8x |
| Cooked Chicken | $60 | 8x |
| Bread | $40 | 8x |

---

## 🔐 Permissions

| Permission | Description | Default |
|---|---|---|
| `kuroshops.shop` | Allows the player to use `/shop` | `true` (all players) |

To restrict `/shop` to operators only, change `default: true` to `default: op` in your `plugin.yml`.

---

## 📁 File Structure

```
KuroShops/
└── src/
    └── Andreykuro/
        └── KuroShops/
            ├── Main.php
            ├── UI/
            │   ├── MainMenu.php
            │   ├── WoodsUI.php
            │   ├── CropsUI.php
            │   └── FoodUI.php
            └── Utils/
                └── Economy.php
```

---

## ⚙️ plugin.yml

```yaml
name: KuroShops
version: 0.0.1
main: Andreykuro\KuroShops\Main
api: 5.42.0
depend:
  - SimpleEconomy

commands:
  shop:
    description: "Open the KuroShops menu"
    usage: "/shop"
    aliases:
      - store
    permission: kuroshops.shop

permissions:
  kuroshops.shop:
    description: "Allows the player to use /shop"
    default: true
```

---

## 👤 Author

**Andreykuro** — KuroShops v0.0.1

---

## 📄 License

This project is provided as-is for use on PocketMine-MP servers.
