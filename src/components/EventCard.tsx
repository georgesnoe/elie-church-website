import EventProps from "@/lib/EventProps";

export default function EventCard({ event }: { event: EventProps }) {
  const { title, description, day, date, time, isPast, imageUrl } = event;

  return (
    <div className={`event-card ${isPast ? 'past' : ''}`}>
      <div className="event-image-placeholder"
        style={{ backgroundImage: imageUrl, backgroundPosition: "center", backgroundSize: "cover" }}>
        {isPast && (
          <div className="past-event-overlay">
            <span className="check-icon">✓</span>
          </div>
        )}
      </div>
      <div className="card-content">
        <h4 className="event-card-title">{title}</h4>
        <p className="event-card-description">{description}</p>
        <div className="event-details">
          <p className="event-card-day">{day}</p>
          <p className="event-card-date">{date}</p>
          <p className="event-card-time">{time}</p>
        </div>
      </div>
    </div>
  );
}
