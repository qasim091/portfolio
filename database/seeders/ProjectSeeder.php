<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'AI-Powered Analytics Dashboard',

                'slug' => 'ai-powered-analytics-dashboard',
                'description' => 'Real-time data visualization with machine learning insights',
                'long_description' => 'A comprehensive analytics platform that leverages machine learning to provide real-time insights and predictive analytics. Features interactive visualizations, custom reports, and automated data processing pipelines.',
                'tech' => ['React', 'Three.js', 'Python', 'TensorFlow'],
                'images' => [
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop&sat=-100'
                ],
                'github' => '#',
                'live' => '#',
                'category_id' => 'Web App',
                'features' => ['Real-time data processing', 'ML-powered insights', 'Custom dashboards', 'Export reports'],
                'challenges' => 'Implementing real-time data synchronization while maintaining high performance across multiple concurrent users.',
                'outcome' => 'Successfully deployed to 500+ users with 99.9% uptime and average response time under 200ms.',
                'is_featured' => true,
                'order' => 1
            ],
            [
                'title' => 'Immersive 3D Portfolio',

                'slug' => 'immersive-3d-portfolio',
                'description' => 'Interactive portfolio with WebGL and physics engine',
                'long_description' => 'A cutting-edge portfolio website featuring interactive 3D elements, physics-based animations, and smooth transitions. Built with modern web technologies to showcase creative projects in an engaging way.',
                'tech' => ['Three.js', 'GSAP', 'WebGL', 'React'],
                'images' => [
                    'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800&h=600&fit=crop&sat=-100'
                ],
                'github' => '#',
                'live' => '#',
                'category_id' => '3D',
                'features' => ['WebGL graphics', 'Physics simulation', 'Particle systems', 'Smooth animations'],
                'challenges' => 'Optimizing 3D rendering performance for mobile devices while maintaining visual quality.',
                'outcome' => 'Achieved 60fps on most devices with reduced polygon count and optimized shaders.',
                'is_featured' => true,
                'order' => 2
            ],
            [
                'title' => 'E-Commerce Platform',

                'slug' => 'e-commerce-platform',
                'description' => 'Modern shopping experience with real-time inventory',
                'long_description' => 'Full-stack e-commerce solution with real-time inventory management, secure payment processing, and personalized shopping experiences. Includes admin dashboard, customer analytics, and multi-vendor support.',
                'tech' => ['Next.js', 'Stripe', 'PostgreSQL', 'Redis'],
                'images' => [
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop&sat=-100'
                ],
                'github' => '#',
                'live' => '#',
                'category_id' => 'Web App',
                'features' => ['Payment processing', 'Inventory management', 'Multi-vendor support', 'Analytics dashboard'],
                'challenges' => 'Building a scalable architecture to handle peak traffic during flash sales.',
                'outcome' => 'Platform successfully handles 10,000+ concurrent users with zero downtime.',
                'is_featured' => false,
                'order' => 3
            ],
            [
                'title' => 'Social Media App',

                'slug' => 'social-media-app',
                'description' => 'Real-time messaging and content sharing platform',
                'long_description' => 'Modern social networking application with real-time messaging, media sharing, and social features. Includes user profiles, news feeds, notifications, and cross-platform support.',
                'tech' => ['React Native', 'Socket.io', 'MongoDB', 'AWS'],
                'images' => [
                    'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=800&h=600&fit=crop&sat=-100'
                ],
                'github' => '#',
                'live' => '#',
                'category_id' => 'Mobile',
                'features' => ['Real-time messaging', 'Media sharing', 'Push notifications', 'User profiles'],
                'challenges' => 'Implementing efficient real-time communication with minimal battery drain.',
                'outcome' => 'App reached 50,000+ downloads with 4.5-star rating on app stores.',
                'is_featured' => false,
                'order' => 4
            ],
            [
                'title' => 'Blockchain Wallet',

                'slug' => 'blockchain-wallet',
                'description' => 'Secure cryptocurrency wallet with multi-chain support',
                'long_description' => 'Decentralized wallet application supporting multiple blockchain networks. Features secure key management, transaction tracking, DeFi integrations, and NFT gallery.',
                'tech' => ['React', 'Web3.js', 'Ethereum', 'IPFS'],
                'images' => [
                    'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1686191128892-3b833d41841a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&h=600&fit=crop&sat=-100'
                ],
                'github' => '#',
                'live' => '#',
                'category_id' => 'Blockchain',
                'features' => ['Multi-chain support', 'Secure key storage', 'NFT gallery', 'DeFi integration'],
                'challenges' => 'Ensuring top-level security for private key storage and transaction signing.',
                'outcome' => 'Successfully audited by security firm with zero critical vulnerabilities found.',
                'is_featured' => true,
                'order' => 5
            ],
            [
                'title' => 'AI Image Generator',

                'slug' => 'ai-image-generator',
                'description' => 'Create stunning images from text descriptions',
                'long_description' => 'Advanced AI-powered image generation tool using state-of-the-art diffusion models. Features prompt engineering, style transfer, image editing, and high-resolution outputs.',
                'tech' => ['Python', 'PyTorch', 'FastAPI', 'React'],
                'images' => [
                    'https://images.unsplash.com/photo-1686191128892-3b833d41841a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1686191128892-3b833d41841a?w=800&h=600&fit=crop&sat=-100'
                ],
                'github' => '#',
                'live' => '#',
                'category_id' => 'AI/ML',
                'features' => ['Text-to-image generation', 'Style transfer', 'Image editing', 'High-resolution output'],
                'challenges' => 'Optimizing model inference time to provide real-time generation experience.',
                'outcome' => 'Reduced average generation time from 30s to 5s through model optimization.',
                'is_featured' => false,
                'order' => 6
            ],
        ];

        foreach ($projects as $projectData) {
            // Look up category ID by name if category_id is a string
            if (isset($projectData['category_id']) && is_string($projectData['category_id'])) {
                $category = Category::where('name', $projectData['category_id'])->first();
                $projectData['category_id'] = $category ? $category->id : null;
            }
            
            Project::create($projectData);
        }
    }
}
