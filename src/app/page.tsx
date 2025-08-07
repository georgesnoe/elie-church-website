import DailyVerse from "@/components/DailyVerse";
import TodayEvent from "@/components/TodayEvent";
import WeekSchedule from "@/components/WeekSchedule";

export default function Home() {
  return (
    <main>
      <DailyVerse />
      <TodayEvent />
      <WeekSchedule />
    </main>
  )
}
