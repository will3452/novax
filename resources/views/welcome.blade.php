<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ODECOR-B Clinic</title>
  <meta name="description" content="ODECOR-B Clinic — compassionate care, modern facilities, and expert clinicians.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
          colors: {
            brand: {
             50: '#fef2f2',
            100: '#fee2e2',
            200: '#fecaca',
            300: '#fca5a5',
            400: '#f87171',
            500: '#ef4444',
            600: '#dc2626',
            700: '#b91c1c',
            800: '#991b1b',
            900: '#7f1d1d',

            }
          }
        }
      }
    }
  </script>
  <style>
    html { scroll-behavior: smooth; }
  </style>
</head>
<body class="antialiased text-slate-800">
  <!-- Top Bar -->
  <div class="bg-brand-900 text-white text-sm">
    <div class="max-w-6xl mx-auto px-4 py-2 flex items-center justify-between">
      <p class="hidden sm:block">Compassionate care. Modern facilities.</p>
      <a href="tel:+639635980829" class="underline underline-offset-4">Call us: +63 963 598 0829</a>
    </div>
  </div>

  <!-- Nav -->
  <header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
      <a href="#" class="flex items-center gap-2">
        <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-brand-600 text-white font-bold">OB</span>
        <span class="font-extrabold tracking-tight text-xl">ODECOR-B Medical Clinic</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 font-medium">
        <a href="#services" class="hover:text-brand-700">Services</a>
        <a href="#about" class="hover:text-brand-700">About</a>
        <a href="#faq" class="hover:text-brand-700">FAQ</a>
        <a href="#contact" class="hover:text-brand-700">Contact</a>
        <a href="/app/login" class="ml-2 inline-flex items-center rounded-xl bg-brand-600 px-4 py-2 text-white hover:bg-brand-700 shadow-sm">Book Now</a>
      </nav>
      <a href="#book" class="md:hidden inline-flex items-center rounded-xl bg-brand-600 px-3 py-2 text-white hover:bg-brand-700">Book</a>
    </div>
  </header>

  <!-- Hero -->
  <section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-brand-50 to-white -z-10"></div>
    <div class="max-w-6xl mx-auto px-4 py-20 lg:py-28 grid lg:grid-cols-12 gap-10 items-center">
      <div class="lg:col-span-7">
        <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight tracking-tight">
          Care that feels personal. <span class="text-brand-700">Results that matter.</span>
        </h1>
        <p class="mt-5 text-lg text-slate-600 max-w-2xl">At ODECOR-B Clinic, our team delivers high-quality, patient-centered healthcare—from routine checkups to specialized treatments—in a calm, modern setting.</p>
        <div class="mt-8 flex flex-wrap gap-3">
          <a id="book" href="#contact" class="inline-flex items-center rounded-xl bg-brand-600 px-5 py-3 text-white hover:bg-brand-700 shadow">Book an Appointment</a>
          <a href="#services" class="inline-flex items-center rounded-xl border border-slate-300 px-5 py-3 hover:border-brand-400 hover:text-brand-700">Explore Services</a>
        </div>
        <div class="mt-6 flex items-center gap-6 text-sm text-slate-600">
          <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-500"></span> DOH-compliant</div>
          <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-500"></span> Same-day slots available</div>
          <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-500"></span> Cash & HMO accepted</div>
        </div>
      </div>
      <div class="lg:col-span-5">
        <div class="relative rounded-2xl overflow-hidden shadow-2xl ring-1 ring-slate-200">
          <img src="/odecor.jpg" alt="Clinic lobby" class="w-full h-80 object-cover">
        </div>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section id="services" class="py-16 lg:py-20 border-t border-slate-200">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex items-end justify-between gap-4 mb-10">
        <h2 class="text-3xl font-extrabold tracking-tight">Our Services</h2>
        <a href="#contact" class="hidden sm:inline-flex text-brand-700 hover:underline">Need something else? Contact us →</a>
      </div>
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card -->
        <article class="rounded-2xl border border-slate-200 p-6 hover:shadow-md transition">
          <h3 class="text-xl font-semibold">General Consultation</h3>
          <p class="mt-2 text-slate-600">Comprehensive checkups, diagnosis, and treatment plans tailored to your needs.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 hover:shadow-md transition">
          <h3 class="text-xl font-semibold">Diagnostics</h3>
          <p class="mt-2 text-slate-600">Basic laboratory tests and imaging referrals for quick, accurate results.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 hover:shadow-md transition">
          <h3 class="text-xl font-semibold">Pediatrics</h3>
          <p class="mt-2 text-slate-600">Well-baby visits, vaccinations, and child-focused care.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 hover:shadow-md transition">
          <h3 class="text-xl font-semibold">Women’s Health</h3>
          <p class="mt-2 text-slate-600">Prenatal care, screenings, and guidance through every stage.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 hover:shadow-md transition">
          <h3 class="text-xl font-semibold">Minor Procedures</h3>
          <p class="mt-2 text-slate-600">Wound care, suturing, and other in-clinic treatments.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 hover:shadow-md transition">
          <h3 class="text-xl font-semibold">Telemedicine</h3>
          <p class="mt-2 text-slate-600">Consult doctors from home using secure video calls.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="py-16 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 grid lg:grid-cols-12 gap-10 items-center">
      <div class="lg:col-span-6">
        <h2 class="text-3xl font-extrabold tracking-tight">About ODECOR-B Clinic</h2>
        <p class="mt-4 text-slate-600">We’re a community-focused clinic committed to high-quality, accessible care. Our multidisciplinary team brings years of experience, supported by modern equipment and friendly staff.</p>
        <ul class="mt-6 space-y-3 text-slate-700">
          <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-brand-600"></span> Board-certified physicians</li>
          <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-brand-600"></span> Transparent pricing</li>
          <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-brand-600"></span> Accessible location & hours</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="py-16 lg:py-20 bg-slate-50 border-y border-slate-200">
    <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-3xl font-extrabold tracking-tight mb-10">What Patients Say</h2>
      <div class="grid md:grid-cols-3 gap-6">
        <figure class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
          <blockquote class="text-slate-700">“The staff were incredibly kind and professional. Booking was easy and I felt well cared for.”</blockquote>
          <figcaption class="mt-4 text-sm text-slate-500">— Mara D.</figcaption>
        </figure>
        <figure class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
          <blockquote class="text-slate-700">“Clean, modern clinic with quick results. Highly recommend!”</blockquote>
          <figcaption class="mt-4 text-sm text-slate-500">— John R.</figcaption>
        </figure>
        <figure class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
          <blockquote class="text-slate-700">“Doctors explained everything clearly and patiently. Great experience.”</blockquote>
          <figcaption class="mt-4 text-sm text-slate-500">— Aileen S.</figcaption>
        </figure>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="py-16 lg:py-20">
    <div class="max-w-4xl mx-auto px-4">
      <h2 class="text-3xl font-extrabold tracking-tight mb-6">Frequently Asked Questions</h2>
      <p class="text-slate-600 mb-8">Can’t find what you’re looking for? <a href="#contact" class="text-brand-700 underline">Contact us</a>.</p>

      <div class="space-y-4">
        <details class="group rounded-2xl border border-slate-200 p-6 open:border-brand-300">
          <summary class="flex cursor-pointer list-none items-center justify-between font-semibold">
            Do you accept walk-ins?
            <span class="ml-4 text-slate-400 group-open:rotate-180 transition">▾</span>
          </summary>
          <p class="mt-3 text-slate-600">Yes, but we recommend booking to secure your preferred time. Same-day slots are often available.</p>
        </details>

        <details class="group rounded-2xl border border-slate-200 p-6">
          <summary class="flex cursor-pointer list-none items-center justify-between font-semibold">
            What payment methods do you accept?
            <span class="ml-4 text-slate-400 group-open:rotate-180 transition">▾</span>
          </summary>
          <p class="mt-3 text-slate-600">We accept cash, major cards, and select HMOs. Please bring a valid ID and HMO card if applicable.</p>
        </details>

        <details class="group rounded-2xl border border-slate-200 p-6">
          <summary class="flex cursor-pointer list-none items-center justify-between font-semibold">
            Where are you located?
            <span class="ml-4 text-slate-400 group-open:rotate-180 transition">▾</span>
          </summary>
          <p class="mt-3 text-slate-600">We’re centrally located. Add your clinic address here (with Google Maps link if available).</p>
        </details>

        <details class="group rounded-2xl border border-slate-200 p-6">
          <summary class="flex cursor-pointer list-none items-center justify-between font-semibold">
            How do I book an appointment?
            <span class="ml-4 text-slate-400 group-open:rotate-180 transition">▾</span>
          </summary>
          <p class="mt-3 text-slate-600">Use the contact form below or call our hotline. An online booking widget can be embedded here later.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="py-16 lg:py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 grid lg:grid-cols-12 gap-10">
      <div class="lg:col-span-12 text-center">
        <h2 class="text-3xl font-extrabold tracking-tight">Get in Touch</h2>
        <p class="mt-4 text-slate-600">Have questions or need to reschedule? We’re here to help.</p>
        <div class="mt-6 space-y-3 text-slate-700">
          <p><strong>Phone:</strong> <a class="text-brand-700 hover:underline" href="tel:+631234567890">+63 963 598 0829</a></p>
          <p><strong>FB Page:</strong> <a class="text-brand-700 hover:underline">Odecor-B Medical Clinic</a></p>
          <p><strong>Hours:</strong> Mon–Sat, 9:00 AM – 4:00 PM</p>
          <p><strong>Address:</strong> #7 Batasan-San Mateo Road, Batasan Hills, , Quezon City, Philippines</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="border-t border-slate-200 bg-slate-50">

    <div class="border-t border-slate-200">
      <div class="max-w-6xl mx-auto px-4 py-6 text-xs text-slate-500 flex flex-wrap items-center justify-between gap-4">
        <p>© <span id="year"></span> ODECOR-B Clinic. All rights reserved.</p>
        <div class="space-x-4">
          <a href="#" class="hover:underline">Privacy</a>
          <a href="#" class="hover:underline">Terms</a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>
</html>
