import DailyVerse from "@/components/DailyVerse";
import TodayEvent from "@/components/TodayEvent";
import WeekSchedule from "@/components/WeekSchedule";
import { Metadata } from "next";

export default function Home() {
  return (
    <main>
      <DailyVerse />
      <TodayEvent />
      <WeekSchedule />
    </main>
  )
}

export const metadata: Metadata = {
  title: "Acceuil • Église méthodiste du Togo",
};
