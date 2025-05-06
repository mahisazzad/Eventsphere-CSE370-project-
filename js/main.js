// main.js

document.addEventListener('DOMContentLoaded', () => {
  // Theme Toggle
  const toggle = document.getElementById('themeToggle');
  if (toggle) {
    toggle.addEventListener('click', () => {
      document.body.classList.toggle('light-mode');
      localStorage.setItem('theme', document.body.classList.contains('light-mode') ? 'light' : 'dark');
    });
  }

  // Contact Form Submission
  const form = document.getElementById('contactForm');
  if (form) {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Thanks for reaching out! We’ll get back to you soon.');
      form.reset();
    });
  }

  // Load theme preference
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'light') {
    document.body.classList.add('light-mode');
  }

  // Ticket PDF Download
  const downloadBtn = document.getElementById('downloadTicketBtn');
  if (downloadBtn) {
    downloadBtn.addEventListener('click', () => {
      const userName = document.getElementById('userName').value.trim();
      const ticketType = document.getElementById('ticketType').value;

      if (!userName) {
        alert('Please enter your name.');
        return;
      }

      const ticketID = `EVT-${Math.floor(Math.random() * 1000000)}`;
      const qrContent = `Name: ${userName}, Ticket Type: ${ticketType}, Ticket ID: ${ticketID}`;

      const qr = new QRious({
        value: qrContent,
        size: 100
      });

      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();

      doc.setFontSize(18);
      doc.text("🎟️ EventSphere - Ticket", 20, 30);

      doc.setFontSize(12);
      doc.text(`Name: ${userName}`, 20, 50);
      doc.text(`Ticket Type: ${ticketType}`, 20, 60);
      doc.text("Event: Dreamy Night Festival", 20, 70);
      doc.text("Date: June 10, 2025", 20, 80);
      doc.text("Location: Starry Arena, Moonville", 20, 90);
      doc.text(`Ticket ID: ${ticketID}`, 20, 100);

      doc.addImage(qr.toDataURL(), 'PNG', 140, 40, 50, 50);
      doc.save(`${userName}_Ticket.pdf`);
    });
  }
});
