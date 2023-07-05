@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="bg-gradient-to-br from-stone-950 to-stone-600 h-full w-full relative">
        <img
            src="https://images.pexels.com/photos/164501/pexels-photo-164501.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
            class="h-full w-full object-cover absolute mix-blend-overlay">
        <div class="p-24">
            <div class="text-white text-6xl font-bold">
                Internet Bank
            </div>
            <div class="text-white text-3xl font-bold">
                + Crypto included
            </div>
        </div>
    </div>

    <div class="grid h-full w-full bg-gray-100 text-black">
        <p class="sm:w-1/2 text-justify p-6 mx-auto">
            Welcome to CryptoBank, your premier destination for
            secure online banking and cryptocurrency
            management. We
            take pride in providing you with a seamless and reliable banking experience. With our cutting-edge
            technology, we ensure the utmost security for your financial transactions and digital assets. Whether you're
            an experienced crypto trader or just starting your journey, CryptoBank has the tools and resources to meet
            your needs.<br><br>

            Our user-friendly interface allows you to effortlessly manage your traditional and digital currencies in one
            convenient location. From checking your account balances to transferring funds, our online banking platform
            offers a wide range of services to cater to your financial requirements. Experience the convenience of 24/7
            access to your accounts from anywhere in the world.<br><br>

            CryptoBank offers a diverse range of cryptocurrencies for you to invest in. From established tokens like
            Bitcoin (BTC), Ethereum (ETH), and Litecoin (LTC) to promising newcomers, our comprehensive selection allows
            you to diversify your portfolio and explore exciting investment opportunities. Take advantage of our
            real-time market data and advanced trading features to make informed investment decisions.<br><br>

            We understand the importance of security in the digital world. That's why we have implemented
            state-of-the-art encryption protocols and multi-factor authentication to safeguard your personal and
            financial information. Our team of cybersecurity experts continuously monitors our systems to ensure that
            your data remains protected at all times.<br><br>

            At CryptoBank, we believe in empowering our customers with the knowledge they need to succeed. Our
            educational resources provide valuable insights into the world of cryptocurrencies and blockchain
            technology. Stay up-to-date with the latest trends, news, and analysis to maximize your potential in the
            ever-evolving digital landscape.<br><br>

            Join CryptoBank today and embark on a secure and rewarding banking journey. Experience the convenience,
            flexibility, and potential of traditional and digital finance combined in one comprehensive platform. Your
            financial future starts here with CryptoBank, your trusted partner in banking and cryptocurrencies.<br><br>
        </p>
    </div>

    @if (session()->exists('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 5000)"
             x-show="show"
             class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif
@endsection

@section('footer')
    @parent
@endsection
