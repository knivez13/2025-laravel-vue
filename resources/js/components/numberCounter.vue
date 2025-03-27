<template>
    <!-- Display the formatted counter -->
    {{
        parseFloat(counter)
            .toFixed(2)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    }}
</template>

<script>
import { gsap } from 'gsap';

export default {
    props: {
        target: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            counter: 0 // Start value
        };
    },
    watch: {
        // Watch for changes to the target prop
        target(newTarget) {
            this.animateNumber(newTarget);
        }
    },
    mounted() {
        // Initialize animation when the component mounts
        this.animateNumber(this.target);
    },
    methods: {
        animateNumber(newTarget) {
            // Check if the current counter is already at the target value
            const currentCounter = this.counter;

            // If the target hasn't changed, don't animate
            if (currentCounter === newTarget) return;

            // Animate the counter from current value to the new target value
            gsap.to(this, {
                counter: newTarget,
                duration: 2, // Animation duration
                ease: 'power1.out', // Easing function for smooth transition
                snap: { counter: 0.01 }, // Snap to two decimal places
                onUpdate: () => {
                    // Format the counter value to 2 decimal places
                    this.counter = parseFloat(this.counter).toFixed(2);
                }
            });
        }
    }
};
</script>
