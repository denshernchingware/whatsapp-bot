<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function sendWhatsappMessage()
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsappNumber = env('TWILIO_WHATSAPP_NUMBER');

        $to = 'whatsapp:+919581735231';
        $message = 'Hello Professor';

        try {
            $twilio = new Client($twilioSid, $twilioToken);

            $twilio->messages->create(
                "whatsapp:+919581735231",
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => "Hello Professor"
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'WhatsApp message sent successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function webhook(Request $request)
    {
        try {
            $from = $request->input('From');
            $body = trim($request->input('Body'));

            Log::info('Received message', ['from' => $from, 'body' => $body]);

            // Don't reply to messages from the Twilio number itself
            if ($from === 'whatsapp:+14155238886') {
                Log::info('Ignoring message from Twilio number');
                return response('', 200);
            }

            $twilio = new Client(
                env('TWILIO_SID'),
                env('TWILIO_AUTH_TOKEN')
            );

            // Get the response based on user input
            $response = $this->getResponse($body);

            // Create message with or without media
            $messageData = [
                'from' => 'whatsapp:+14155238886',
                'body' => $response['body'],
            ];

            // Add media if present
            if (!empty($response['media'])) {
                $messageData['mediaUrl'] = $response['media'];
            }

            $message = $twilio->messages->create($from, $messageData);

            Log::info('Message sent successfully', ['sid' => $message->sid]);
        } catch (\Exception $e) {
            Log::error('Webhook error: ' . $e->getMessage());
        }

        return response('', 200);
    }

    private function getResponse($userMessage)
    {
        $message = strtolower($userMessage);

        // Main Menu
        if (in_array($message, ['hi', 'hello', 'hey', 'menu', 'start'])) {
            return [
                'body' => "👋 Welcome to Our Business!\n\n" .
                    "Please select a service:\n\n" .
                    "1️⃣ Web Development\n" .
                    "2️⃣ Mobile App Development\n" .
                    "3️⃣ Digital Marketing\n" .
                    "4️⃣ UI/UX Design\n" .
                    "5️⃣ Cloud Solutions\n\n" .
                    "📞 Type 'contact' for contact information\n" .
                    "🖼️ Type 'portfolio' to see our work\n\n" .
                    "Type the number (1-5) to learn more!",
                'media' => []
            ];
        }

        // Service 1: Web Development - WITH IMAGE
        if (in_array($message, ['1', 'web', 'web development'])) {
            return [
                'body' => "🌐 *Web Development*\n\n" .
                    "We create modern, responsive websites tailored to your business needs.\n\n" .
                    "✨ Features:\n" .
                    "• Custom website design\n" .
                    "• E-commerce solutions\n" .
                    "• CMS integration\n" .
                    "• SEO optimization\n" .
                    "• Maintenance & support\n\n" .
                    "💰 Starting from ₹25,000\n\n" .
                    "Type 'menu' to go back or 'contact' to reach us!",
                'media' => ['https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800'] // Example image
            ];
        }

        // Service 2: Mobile App Development - WITH IMAGE
        if (in_array($message, ['2', 'mobile', 'app', 'mobile app'])) {
            return [
                'body' => "📱 *Mobile App Development*\n\n" .
                    "Native and cross-platform mobile applications for iOS and Android.\n\n" .
                    "✨ Features:\n" .
                    "• iOS & Android apps\n" .
                    "• Cross-platform development\n" .
                    "• API integration\n" .
                    "• Push notifications\n" .
                    "• App store deployment\n\n" .
                    "💰 Starting from ₹50,000\n\n" .
                    "Type 'menu' to go back or 'contact' to reach us!",
                'media' => ['https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800']
            ];
        }

        // Service 3: Digital Marketing - WITH IMAGE
        if (in_array($message, ['3', 'marketing', 'digital marketing'])) {
            return [
                'body' => "📊 *Digital Marketing*\n\n" .
                    "Boost your online presence and reach your target audience effectively.\n\n" .
                    "✨ Features:\n" .
                    "• Social media marketing\n" .
                    "• Google Ads campaigns\n" .
                    "• Content marketing\n" .
                    "• Email marketing\n" .
                    "• Analytics & reporting\n\n" .
                    "💰 Starting from ₹15,000/month\n\n" .
                    "Type 'menu' to go back or 'contact' to reach us!",
                'media' => ['https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800']
            ];
        }

        // Service 4: UI/UX Design - WITH IMAGE
        if (in_array($message, ['4', 'design', 'ui', 'ux', 'ui/ux'])) {
            return [
                'body' => "🎨 *UI/UX Design*\n\n" .
                    "Beautiful, user-friendly designs that enhance user experience.\n\n" .
                    "✨ Features:\n" .
                    "• User research\n" .
                    "• Wireframing & prototyping\n" .
                    "• Visual design\n" .
                    "• Usability testing\n" .
                    "• Design systems\n\n" .
                    "💰 Starting from ₹20,000\n\n" .
                    "Type 'menu' to go back or 'contact' to reach us!",
                'media' => ['https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800']
            ];
        }

        // Service 5: Cloud Solutions - WITH IMAGE
        if (in_array($message, ['5', 'cloud', 'cloud solutions'])) {
            return [
                'body' => "☁️ *Cloud Solutions*\n\n" .
                    "Scalable cloud infrastructure and migration services.\n\n" .
                    "✨ Features:\n" .
                    "• Cloud migration\n" .
                    "• AWS/Azure/GCP setup\n" .
                    "• DevOps automation\n" .
                    "• Security & compliance\n" .
                    "• 24/7 monitoring\n\n" .
                    "💰 Starting from ₹30,000\n\n" .
                    "Type 'menu' to go back or 'contact' to reach us!",
                'media' => ['https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800']
            ];
        }

        // Portfolio - MULTIPLE IMAGES
        if (in_array($message, ['portfolio', 'work', 'projects'])) {
            return [
                'body' => "🎨 *Our Portfolio*\n\n" .
                    "Here are some of our recent projects!\n\n" .
                    "We've worked with 100+ clients across various industries.\n\n" .
                    "Type 'contact' to discuss your project!",
                'media' => [
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800',
                    'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800',
                    'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800'
                ]
            ];
        }

        // Contact Information
        if (in_array($message, ['contact', 'info', 'reach'])) {
            return [
                'body' => "📞 *Contact Us*\n\n" .
                    "We'd love to hear from you!\n\n" .
                    "📧 Email: info@yourbusiness.com\n" .
                    "📱 Phone: +91 95817 35231\n" .
                    "🌐 Website: www.yourbusiness.com\n" .
                    "📍 Address: Kakinada, Andhra Pradesh, India\n\n" .
                    "⏰ Business Hours:\n" .
                    "Mon-Fri: 9:00 AM - 6:00 PM\n" .
                    "Sat: 10:00 AM - 4:00 PM\n\n" .
                    "Type 'menu' to see our services again!",
                'media' => []
            ];
        }

        // Default response
        return [
            'body' => "I didn't understand that. 🤔\n\n" .
                "Type 'menu' to see available services or 'contact' to reach us!",
            'media' => []
        ];
    }
}
