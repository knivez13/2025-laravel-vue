<?php

use App\Models\Maintenance\Amenity;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
        $amenities = [
            "24/7 Security",
            "Air Conditioning",
            "Alarm System",
            "Automatic Doors",
            "Backup Power Supply",
            "Basement Parking",
            "Bike Racks",
            "Building Reception",
            "CCTV Surveillance",
            "Centralized HVAC System",
            "Conference Rooms",
            "Covered Parking",
            "Elevators",
            "Emergency Lighting",
            "Entrance Lobby",
            "Ergonomic Office Chairs",
            "Exhaust Fans",
            "Fire Alarm System",
            "Fire Extinguishers",
            "Fitness Center",
            "Floor-to-Ceiling Windows",
            "Furnished Offices",
            "Green Building Certification",
            "High-Speed Internet",
            "High-Speed Elevators",
            "Indoor Plants",
            "Intercom System",
            "Internet Cafes",
            "Janitorial Services",
            "Keyless Entry",
            "Kitchenette",
            "Landscaped Gardens",
            "Laundry Facilities",
            "Meeting Rooms",
            "On-Site ATM",
            "On-Site Dining Options",
            "On-Site Parking",
            "Outdoor Seating Area",
            "Outdoor Terraces",
            "Pet-Friendly Areas",
            "Phone Booths",
            "Private Office Spaces",
            "Private Restrooms",
            "Recreational Areas",
            "Retail Stores",
            "Rooftop Lounge",
            "Satellite TV",
            "Shared Office Spaces",
            "Shuttle Service",
            "Smart Building Technology",
            "Smoke Detectors",
            "Storage Units",
            "Sustainable Building Features",
            "Tactical Lighting",
            "Teleconference Facilities",
            "Tesla Charging Stations",
            "Tiled Floors",
            "Visitor Parking",
            "Voice-Activated Systems",
            "Water Fountains",
            "Wi-Fi",
            "Wheelchair Accessibility",
            "Workstations",
            "Wireless Charging Stations",
            "Window Blinds",
            "Yoga Studio",
            "Zoning for Commercial Use",
            "24/7 Access",
            "Automated Lighting",
            "Business Center",
            "Cafe & Coffee Bar",
            "Childcare Services",
            "Coffee Machines",
            "Collaborative Spaces",
            "Common Area Maintenance",
            "Community Events",
            "Dedicated Wi-Fi Network",
            "Document Scanning Services",
            "Dry Cleaning Services",
            "Employee Lounge",
            "Event Hosting Facilities",
            "Exclusive Business Networking Events",
            "Flexible Lease Terms",
            "Full-Service Printing",
            "Furnished Meeting Rooms",
            "Garage Parking",
            "Guest Parking",
            "Health and Safety Protocols",
            "High-Quality Flooring",
            "Integrated Video Conferencing",
            "Internet of Things (IoT) Enabled",
            "Large Windows for Natural Light",
            "Mobile Device Charging Stations",
            "On-Site Bank",
            "On-Site Car Wash",
            "On-Site Pharmacy",
            "Open Space Design",
            "Outdoor Meeting Areas",
            "Pet Care Services",
            "Private Lounge Areas",
            "Public Transportation Access",
            "Raised Flooring",
            "Reception Services",
            "Recycling Stations",
            "Retail Shops Inside",
            "Robotic Mailbox",
            "Self-Storage Services",
            "Shower Facilities",
            "Smart Lighting",
            "Solar Panels",
            "Soundproof Rooms",
            "Sustainability Initiatives",
            "Tech Support Services",
            "Telemedicine Services",
            "Technology-Infrastructure Support",
            "Themed Meeting Rooms",
            "Video Surveillance",
            "Virtual Office Services",
            "Walk-In Closets",
            "Water Conservation Systems",
            "Wellness Programs"
        ];
        foreach ($amenities as $u) {
            Amenity::create(['code' => $u, 'description' => $u]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
