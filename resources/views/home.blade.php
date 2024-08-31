@extends('layouts.app')

@section('additional_styles')
<style>
    #animated-heading {
        color: white;
        /* Start with opacity 0 to fade in */
    }
</style>
@endsection

@section('content')
    <section class="intro-section">
        <video autoplay muted loop>
            <source src="{{ asset('images/eve2.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="intro-overlay filter d-flex flex-column">
            <h1 id="animated-heading" class="text-white">Sakagami Incorporated.</h1>
            <strong>New Eden's Premier Corporation</strong>
        </div>
    </section>
@endsection

@section('additional_scripts')
    @parent
    <script>
        // Wrap your GSAP animation inside a DOMContentLoaded event listener
        document.addEventListener("DOMContentLoaded", function() {
            const heading = document.getElementById('animated-heading');
            const tl = gsap.timeline();
            const chars = Array.from(heading.textContent);
            heading.textContent = '';
            chars.forEach((char, index) => {
                const charElement = document.createElement('span');
                charElement.textContent = char;
                heading.appendChild(charElement);
                tl.from(charElement, {
                    duration: 0.05,
                    opacity: 0,
                    ease: 'power4.out',
                });
            });
            tl.play();
        });
        </script>
@endsection
