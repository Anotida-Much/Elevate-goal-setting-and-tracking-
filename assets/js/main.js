document.addEventListener("DOMContentLoaded", () => {
// Displaying Quotes
  const quotes = [
    {
      saying: "Believe you can and you're halfway there.",
      author: "Theodore Roosevelt",
    },
    {
      saying:
        "Set specific, measurable, and achievable goals to boost your productivity.",
      author: "Unknown",
    },
    {
      saying: "You miss 100% of the shots you don't take.",
      author: "Wayne Gretzky",
    },
    {
      saying: "The only way to do great work is to love what you do.",
      author: "Steve Jobs",
    },
    {
      saying:
        "You are never too old to set another goal or to dream a new dream.",
      author: "C.S. Lewis",
    },
    {
      saying: "Do something today that your future self will thank you for.",
      author: "Unknown",
    },
    {
      saying:
        "You don't have to be great to start, but you have to start to be great.",
      author: "Zig Ziglar",
    },
    {
      saying: "Keep your eyes on the stars and your feet on the ground.",
      author: "Theodore Roosevelt",
    },
    {
      saying:
        "Success is not final, failure is not fatal: It is the courage to continue that counts.",
      author: "Winston Churchill",
    },
    {
      saying:
        "Stay positive and focused: Maintain a positive mindset and stay focused on your goals.",
      author: "Unknown",
    },
    {
      saying:
        "Break tasks into smaller steps: Divide large tasks into smaller, manageable steps to maintain momentum.",
      author: "Unknown",
    },
    {
      saying: "Don't watch the clock; do what it does. Keep going.",
      author: "Sam Levenson",
    },
    {
      saying:
        "Celebrate your small wins to stay motivated and focused on your long-term goals.",
      author: "Unknown",
    },
    {
      saying:
        "Set SMART goals: Make your goals Specific, Measurable, Achievable, Relevant, and Time-bound.",
      author: "Unknown",
    },
    {
      saying:
        "Learn from failures: Use failures as opportunities to learn and grow.",
      author: "Unknown",
    },
    {
      saying: "It takes courage to grow up and become who you really are.",
      author: "E.E. Cummings",
    },
    {
      saying:
        "Your self-worth is determined by you. You don't have to depend on someone telling you who you are.",
      author: "Beyonce",
    },
    {
      saying: "Nothing is impossible. The word itself says 'I'm possible!'",
      author: "Audrey Hepburn",
    },
    {
      saying:
        "Keep your face always toward the sunshine, and shadows will fall behind you.",
      author: "Walt Whitman",
    },
    {
      saying:
        "You have brains in your head. You have feet in your shoes. You can steer yourself any direction you choose.",
      author: "Dr. Seuss",
    },
    {
      saying: "Attitude is a little thing that makes a big difference.",
      author: "Winston Churchill",
    },
    {
      saying:
        "To bring about change, you must not be afraid to take the first step. We will fail when we fail to try.",
      author: "Rosa Parks",
    },
    {
      saying:
        "All our dreams can come true, if we have the courage to pursue them.",
      author: "Walt Disney",
    },
    {
      saying:
        "Don't sit down and wait for the opportunities to come. Get up and make them.",
      author: "Madam C.J. Walker",
    },
    {
      saying: "Champions keep playing until they get it right.",
      author: "Billie Jean King",
    },
    {
      saying:
        "I am lucky that whatever fear I have inside me, my desire to win is always stronger.",
      author: "Serena Williams",
    },
    {
      saying:
        "It is during our darkest moments that we must focus to see the light.",
      author: "Aristotle",
    },
    {
      saying: "Life shrinks or expands in proportion to one's courage.",
      author: "Anais Nin",
    },
    {
      saying:
        "Just don't give up trying to do what you really want to do. Where there is love and inspiration, I don't think you can go wrong.",
      author: "Ella Fitzgerald",
    },
    {
      saying: "Try to be a rainbow in someone's cloud.",
      author: "Maya Angelou",
    },
    {
      saying:
        "If you don't like the road you're walking, start paving another one.",
      author: "Dolly Parton",
    },
    {
      saying: "Real change, enduring change, happens one step at a time.",
      author: "Ruth Bader Ginsburg",
    },
    {
      saying:
        "All dreams are within reach. All you have to do is keep moving towards them.",
      author: "Viola Davis",
    },
    {
      saying: "It is never too late to be what you might have been.",
      author: "George Eliot",
    },
    {
      saying:
        "When you put love out in the world it travels, and it can touch people and reach people in ways that we never even expected.",
      author: "Laverne Cox",
    },
    {
      saying: "Give light and people will find the way.",
      author: "Ella Baker",
    },
    {
      saying: "It always seems impossible until it's done.",
      author: "Nelson Mandela",
    },
    {
      saying: "Don't count the days, make the days count.",
      author: "Muhammad Ali",
    },
    {
      saying: "If you risk nothing, then you risk everything.",
      author: "Geena Davis",
    },
    {
      saying: "Definitions belong to the definers, not the defined.",
      author: "Toni Morrison",
    },
    {
      saying: "When you have a dream, you've got to grab it and never let go.",
      author: "Carol Burnett",
    },
    {
      saying:
        "Never allow a person to tell you no who doesn't have the power to say yes.",
      author: "Eleanor Roosevelt",
    },
    {
      saying: "When it comes to luck, you make your own.",
      author: "Bruce Springsteen",
    },
    {
      saying: "If you're having fun, that's when the best memories are built.",
      author: "Simone Biles",
    },
    {
      saying: "Failure is the condiment that gives success its flavor.",
      author: "Truman Capote",
    },
    {
      saying:
        "Hard things will happen to us. We will recover. We will learn from it. We will grow more resilient because of it.",
      author: "Taylor Swift",
    },
    {
      saying:
        "Your story is what you have, what you will always have. It is something to own.",
      author: "Michelle Obama",
    },
    {
      saying:
        "To live is the rarest thing in the world. Most people just exist.",
      author: "Oscar Wilde",
    },
    {
      saying: "You define beauty yourself, society doesn't define your beauty.",
      author: "Lady Gaga",
    },
    {
      saying:
        "Optimism is a happiness magnet. If you stay positive, good things and good people will be drawn to you.",
      author: "Mary Lou Retton",
    },
    {
      saying:
        "You just gotta keep going and fighting for everything, and one day you'll get to where you want.",
      author: "Naomi Osaka",
    },
    {
      saying: "If you prioritize yourself, you are going to save yourself.",
      author: "Gabrielle Union",
    },
    {
      saying:
        "No matter how far away from yourself you may have strayed, there is always a path back. You already know who you are and how to fulfill your destiny.",
      author: "Oprah Winfrey",
    },
  ];

  function displayRandomQuote() {
    const randomNumber = Math.floor(Math.random() * quotes.length);
    const randomSaying = quotes[randomNumber].saying;
    const author = quotes[randomNumber].author;
    document.getElementById("randomQuote").innerHTML = `${randomSaying}`;
    document.getElementById("author").innerHTML = `~${author}`;
  }

  displayRandomQuote();
  setInterval(displayRandomQuote, 60000);

  // Initialize AOS
  AOS.init();
});

// Date and Time
const dateInfo = document.getElementById("date-info");
const todayDt = document.getElementById("today");

function calculateDays() {
  const today = new Date();
  const year = today.getFullYear();
  const firstDayOfYear = new Date(year, 0, 1);
  const lastDayOfYear = new Date(year, 11, 31);

  const daysPassed = Math.floor(
    (today - firstDayOfYear) / (1000 * 60 * 60 * 24)
  );
  const daysLeft = Math.floor((lastDayOfYear - today) / (1000 * 60 * 60 * 24));
  todayDt.textContent = `${today.toLocaleDateString()}`;
  dateInfo.innerHTML = `
    <div class="row justify-content-between">
      <span class="col-auto">Days Passed: <strong>${daysPassed}</strong></span>
      <span class="col-auto">Days Left: <strong>${daysLeft}</strong></span>
    </div>
  `;
}

document.addEventListener("DOMContentLoaded", () => {
  calculateDays();
});

setInterval(calculateDays, 86400000); // 86400000 milliseconds = 1 day

