# 📱 WhatsApp Business Chatbot

A keyword-driven WhatsApp chatbot for IT service businesses that handles service discovery, customer registration, and contact information — all through simple text commands.

---

## 📸 Screenshots

### 1. Main Menu
The bot greets users with a numbered list of services and available commands.

> Users type a number (1–5) to explore a service, or use keywords like `register`, `contact`, or `portfolio`.

![Main Menu](./screenshots/menu.png)

---

### 2. Service Detail — Web Development
Typing `1` returns a rich service card with an image, feature list, and pricing.

![Web Development](./screenshots/web_dev.png)

---

### 3. Service Detail — Cloud Solutions
Typing `5` shows the Cloud Solutions card with features and starting price.

![Cloud Solutions](./screenshots/cloud.png)

---

### 4. Registration Flow
Typing `register` checks if the user is already registered and shows their saved details.

![Register](./screenshots/register.png)

---

### 5. Contact Information
Typing `contact` returns the business address, phone, email, website, and business hours.

![Contact](./screenshots/contact.png)

---

## 🤖 How It Works

The bot listens for incoming WhatsApp messages and matches them against a set of **keywords** and **numbered commands**:

| User Input | Bot Response |
|------------|--------------|
| `menu` | Shows the main services menu |
| `1` | Web Development details |
| `2` | Mobile App Development details |
| `3` | Digital Marketing details |
| `4` | UI/UX Design details |
| `5` | Cloud Solutions details |
| `register` | Registers user or shows existing details |
| `contact` | Displays business contact info |
| `portfolio` | Shows previous work/portfolio |

---

## 🛠️ Services Offered

| # | Service | Starting Price |
|---|---------|----------------|
| 1 | 🌐 Web Development | ₹25,000 |
| 2 | 📱 Mobile App Development | — |
| 3 | 📊 Digital Marketing | — |
| 4 | 🎨 UI/UX Design | — |
| 5 | ☁️ Cloud Solutions | ₹30,000 |

### Web Development Features
- Custom website design
- E-commerce solutions
- CMS integration
- SEO optimization
- Maintenance & support

### Cloud Solutions Features
- Cloud migration
- AWS / Azure / GCP setup
- DevOps automation
- Security & compliance
- 24/7 monitoring

---

## 👤 User Registration

When a user types `register`, the bot either:
- **Registers them** as a new customer (collecting name & email), or
- **Displays their existing details** if they've already signed up.

**Example response for an existing user:**
```
✅ You're already registered!

📝 Your Details:
Name: Densher Chingware
Email: densherchingware13@gmail.com

Type 'menu' to see our services!
```

---

## 📞 Contact Information

```
📧 Email:   info@yourbusiness.com
📱 Phone:   +91 95817 35231
🌐 Website: www.yourbusiness.com
📍 Address: Kakinada, Andhra Pradesh, India

🕐 Business Hours:
   Mon–Fri: 9:00 AM – 6:00 PM
   Sat:     10:00 AM – 4:00 PM
```

---

## 🏗️ Tech Stack (Suggested)

| Layer | Technology |
|-------|------------|
| Messaging API | [Twilio WhatsApp API](https://www.twilio.com/whatsapp) or [Meta Cloud API](https://developers.facebook.com/docs/whatsapp) |
| Backend | Node.js / Python (Flask or FastAPI) |
| Database | MySQL / MongoDB (for user registration) |
| Hosting | AWS / Heroku / Railway |

---

## 🚀 Setup Overview

1. **Connect a WhatsApp Business number** via Twilio or Meta Business API.
2. **Set up a webhook** to receive incoming messages.
3. **Implement keyword matching** logic in your backend.
4. **Store registered users** in a database.
5. **Deploy** and link the webhook URL to your WhatsApp number.

---

## 📌 Notes

- All interactions are **text-based** — users never need to click buttons.
- Service cards include an **image + description + features + price**.
- The bot is designed for a **single-business IT services** use case but can be adapted for any domain.
- Registration is **per WhatsApp number** — no separate login required.

---

*Built for IT service businesses looking to automate lead generation and customer engagement via WhatsApp.*
