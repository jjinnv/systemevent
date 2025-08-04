// upcming event secition // 
document.addEventListener("DOMContentLoaded", () => {
  const events = [
    {
      title: "Marching Training",
      date: "12 Aug 2025",
      time: "9:00 AM – 11:00 AM",
      location: "Pusat Sukan",
    },
    {
      title: "Latihan Tambahan",
      date: "15 Aug 2025",
      time: "2:00 PM – 4:00 PM",
      location: "Dewan Sri Phor Tay",
    },
    {
      title: "Reading Circle",
      date: "20 Aug 2025",
      time: "10:00 AM – 12:00 PM",
      location: "Sudut Bacaan",
    },
  ];

  const eventList = document.querySelector(".event-list");
  if (eventList) {
    eventList.innerHTML = ""; // Clear placeholder
    events.forEach(event => {
      const card = document.createElement("div");
      card.className = "event-card";
      card.innerHTML = `
        <h2>${event.title}</h2>
        <p><strong>Date:</strong> ${event.date}</p>
        <p><strong>Time:</strong> ${event.time}</p>
        <p><strong>Location:</strong> ${event.location}</p>
      `;
      eventList.appendChild(card);
    });
  }


});
