"use client";

import FileUpload from "../fileUpload";

const AnalyzerContainer = () => {
  return (
    <div className="flex min-h-screen">
      {/* Left Section (Black background with description) */}
      <div className="w-1/2 bg-black text-white px-14 py-6 flex flex-col justify-center">
        <h1 className="text-2xl font-bold mb-4">Accessibility Analyzer</h1>
        <p className="text-lg">
          Our Accessibility Analyzer helps you evaluate the accessibility of your HTML files by identifying issues like missing alt texts, incorrect heading structures, and more. By uploading your HTML files, you can receive a detailed analysis and suggested fixes for improving your website accessibility.
        </p>
      </div>

      {/* Right Section (File upload with white background) */}
      <div className="w-1/2 bg-white p-6 flex flex-col justify-center shadow-lg rounded-lg overflow-y-auto">
        <FileUpload />
      </div>
    </div>
  );
};

export default AnalyzerContainer;
