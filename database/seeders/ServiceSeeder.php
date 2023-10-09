<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'title' => 'Braces',
            'description' => "Braces are a common orthodontic treatment that involves the use of metal or ceramic brackets attached to the teeth and connected by wires. They are used to correct misaligned teeth and bite issues, resulting in a straighter and healthier smile. Braces gradually guide the teeth into their proper positions, improving both oral function and aesthetics.",
            'image' => 'services/service-braces.jpg'
        ]);

        Service::create([
            'title' => 'Veneers',
            'description' => "Dental veneers are thin, custom-made shells that are bonded to the front surface of teeth. They are an excellent solution for improving the appearance of teeth that are discolored, stained, chipped, or misaligned. Veneers provide a natural-looking and durable solution to enhance your smile.",
            'image' => 'services/service-veeners.jpg'
        ]);

        Service::create([
            'title' => 'Implants',
            'description' => "Dental implants are artificial tooth roots made of biocompatible materials like titanium. They are surgically placed into the jawbone to replace missing teeth. Implants serve as a sturdy foundation for dental crowns, bridges, or dentures, restoring both the appearance and functionality of natural teeth.",
            'image' => 'services/service-implant.jpg'
        ]);

        Service::create([
            'title' => 'Extraction',
            'description' => "Dental extractions involve the removal of a damaged, decayed, or problematic tooth. This procedure is performed when a tooth cannot be saved or poses a risk to the surrounding teeth and gums. Extractions are carried out with care and may be followed by restorative options like implants or dentures.",
            'image' => 'services/service-extraction.jpg'
        ]);

        Service::create([
            'title' => 'Tooth Fillings',
            'description' => "Tooth fillings are used to repair teeth that have cavities or minor damage. They involve the removal of decayed tooth material and the placement of a filling material, such as composite resin or amalgam, to restore the tooth's structure and function.",
            'image' => 'services/service-tooth-filling.jpg'
        ]);

        Service::create([
            'title' => 'Oral Prophylaxis',
            'description' => "Oral prophylaxis, commonly known as teeth cleaning, is a preventive dental procedure. It involves the removal of plaque, tartar, and stains from the teeth's surfaces. Regular oral prophylaxis appointments help maintain optimal oral health and prevent common dental issues like gum disease and cavities.",
            'image' => 'services/service-oral-prophylaxis.jpg'
        ]);

        Service::create([
            'title' => 'Complete Denture',
            'description' => "Complete dentures are removable prosthetic devices that replace all of the natural teeth in an arch (upper or lower). They are custom-made to fit comfortably and securely in the mouth, restoring the ability to chew, speak, and smile for those who have lost all their teeth in an arch.",
            'image' => 'services/service-complete-denture.jpg'
        ]);

        Service::create([
            'title' => 'Root Canal Treatment',
            'description' => "Root canal treatment is a dental procedure performed to save a tooth that has an infected or damaged pulp (the inner part of the tooth). During the procedure, the pulp is removed, the root canal is cleaned and sealed, and the tooth is usually restored with a crown. This treatment relieves pain and preserves the natural tooth.",
            'image' => 'services/service-root-canal-treatment.jpg'
        ]);

        Service::create([
            'title' => 'Removable Partial Denture',
            'description' => "Removable partial dentures are dental prostheses designed to replace missing teeth when some natural teeth remain in the arch. They consist of artificial teeth attached to a metal or acrylic base and are secured in place with clasps or other attachments. Partial dentures improve both function and appearance.",
            'image' => 'services/service-removal-partial-denture.jpg'
        ]);

        Service::create([
            'title' => 'Preventive Dental Care',
            'description' => "Prevent dental problems before they start with our comprehensive preventive dental care. Regular check-ups, cleanings, and dental education help maintain your oral health. We focus on early detection and tailored preventive measures to keep your smile healthy and beautiful.",
            'image' => 'services/preventive-dental-care.jpg'
        ]);

        Service::create([
            'title' => 'Cosmetic Dentistry',
            'description' => "Enhance the appearance of your teeth and overall smile with our cosmetic dentistry options. From porcelain veneers and teeth bonding to smile makeovers, we offer personalized treatments to transform your smile and boost your self-confidence.",
            'image' => 'services/cosmetic-dentistry.jpg'
        ]);

        Service::create([
            'title' => 'Emergency Dentistry',
            'description' => "Life is unpredictable, and dental emergencies can happen anytime. Our emergency dentistry services are here to provide immediate relief and expert care for issues like severe toothaches, broken teeth, or sudden injuries. We're here when you need us most.",
            'image' => 'services/emergency-dentistry.jpg'
        ]);

        Service::create([
            'title' => 'Tooth Whitening',
            'description' => "Achieve a brighter, more radiant smile with our tooth whitening services. We use safe and effective methods to remove stains and discoloration, leaving your teeth several shades whiter. Enjoy a confident, dazzling smile.",
            'image' => 'services/tooth-whitening.jpg'
        ]);
    }
}
