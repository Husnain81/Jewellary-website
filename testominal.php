<section class="testimonial">
    <h2>TESTIMONIAL</h2>
    <div class="testimonial-box" id="testimonial-box">
        <!-- Testimonials will be dynamically inserted here -->
    </div>
    <div class="testimonial-arrow">
        <i class='bx bx-chevrons-left' id="prev" style="opacity: 0.5;"></i>
        <br>
        <i class='bx bx-chevrons-right' id="next"></i>
    </div>
</section>

<script>
    let currentTestimonial = 0;
    let testimonials = [];

    async function fetchTestimonials() {
        try {
            const response = await fetch('fetch_testimonial.php');
            const data = await response.json();
            //////here check the condition that data comes or not/////////
            if (!data.error) {
                testimonials = data;
                renderTestimonials();
                showTestimonials(currentTestimonial);
            } else {
                console.error(data.error);
            }
        } catch (error) {
            console.error('Error fetching testimonials:', error);
        }
    }

    function renderTestimonials() {
        const testimonialBox = document.getElementById('testimonial-box');
        testimonialBox.innerHTML = '';

        testimonials.forEach((testimonial, index) => {
            const testimonialItem = document.createElement('div');
            testimonialItem.className = 'testimonial-item';
            if (index === 0) testimonialItem.classList.add('active');
            testimonialItem.innerHTML = `
            <div class="testimonial-girl-pic" alt="">
                <img src="${testimonial.image}" id="testimonial-img">
            </div>
            <div class="testimonial-text">
                <h3 id="testimonial-name">${testimonial.name}</h3>
                <p id="testimonial-desc"><span>${testimonial.description}</span></p>
                <i class='bx bxs-quote-right'></i>
            `;
            testimonialBox.appendChild(testimonialItem);
        });
    }

    function showTestimonials(index) {
        if (index < 0 || index >= testimonials.length) return;

        const testimonialItems = document.querySelectorAll('.testimonial-item');
        testimonialItems.forEach((item, i) => {
            item.classList.remove('active');
            if (i === index) {
                item.classList.add('active');
            }
        });

        updateArrows();
    }

    function updateArrows() {
        document.getElementById('prev').style.opacity = currentTestimonial === 0 ? '0.5' : '1';
        document.getElementById('next').style.opacity = currentTestimonial === testimonials.length - 1 ? '0.5' : '1';
    }

    document.getElementById('next').addEventListener('click', () => {
        if (currentTestimonial < testimonials.length - 1) {
            currentTestimonial++;
            showTestimonials(currentTestimonial);
        }
    });

    document.getElementById('prev').addEventListener('click', () => {
        if (currentTestimonial > 0) {
            currentTestimonial--;
            showTestimonials(currentTestimonial);
        }
    });

    fetchTestimonials();
</script>

<style>
    .testimonial-item {
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .testimonial-item.active {
        display: flex;
        animation: slideIn 0.5s forwards;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(0);
        }
    }

    .testimonial-box {
        overflow: hidden;
        position: relative;
    }
</style>