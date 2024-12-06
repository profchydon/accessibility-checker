import type { Metadata } from "next";

export const metadata: Metadata = {
  title: "HTML Analyzer",
  description: "Analyze accessibility issues using a rule-based algorithm",
};

export default function AnalyzerLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return <>{children}</>;
}
