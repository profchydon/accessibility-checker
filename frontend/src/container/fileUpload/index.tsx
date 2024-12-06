import { useGetAnalysisMutation } from "@/api/baseQueries/analyzer/getAnalysis";
import { IIssue } from "@/types";
import React, { useState } from "react";
import { AiOutlineCloudUpload } from "react-icons/ai"; // Importing an icon from react-icons

const FileUpload = () => {
  const [file, setFile] = useState<File | null>(null);
  const [completed, setCompleted] = useState(false);
  const [getAnalysis, { isLoading, isError, data }] = useGetAnalysisMutation();

  const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    if (event.target.files && event.target.files[0]) {
      setFile(event.target.files[0]);
    }
  };

  const handleUpload = async () => {
    if (!file) return;

    // Prepare the FormData object
    const formData = new FormData();
    formData.append("file", file);

    try {
      const payload = {
        file: formData
      };

      await getAnalysis(payload).unwrap();
      setCompleted(true);
    } catch (err) {
      console.error("Upload failed:", err);
    }
  };

  const handleRestart = () => {
    // Reset the form and the state
    setFile(null);
    setCompleted(false);
  };

  return (
    <div className="p-6 max-w-xl mx-auto">
      {/* Show upload form if not completed */}
      {!completed && (
        <>
          {/* Custom file input with button and icon */}
          <label className="w-full bg-blue-600 hover:bg-blue-700 text-white p-5 rounded-md cursor-pointer text-center flex items-center justify-center space-x-3 mb-4">
            <AiOutlineCloudUpload className="text-3xl text-black" />
            <span className="text-lg text-black">Choose HTML File</span>
            <input
              type="file"
              accept=".html, .htm"
              onChange={handleFileChange}
              className="hidden" // Hide the default file input
            />
          </label>

          {/* Show the name of the selected file */}
          {file && (
            <div className="text-center mb-4 text-gray-800">
              <p className="text-sm font-medium">Selected file: {file.name}</p>
            </div>
          )}

          {/* Show the Upload button only if a file has been selected */}
          {file && (
            <button
              onClick={handleUpload}
              disabled={!file || isLoading}
              className={`w-full p-3 mb-6 text-white bg-black rounded-md ${isLoading ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700'}`}
            >
              {isLoading ? "Uploading..." : "Upload File"}
            </button>
          )}
        </>
      )}

      {isError && !completed && (
        <p className="text-red-600 text-center mb-4">
          There was an error processing the file
        </p>
      )}

      {/* Show analysis results and restart button when completed */}
      {completed && data && (
        <div className="mt-8">
          <h3 className="text-xl font-semibold text-center text-gray-800 mb-4">Analysis Result:</h3>
          <div className="bg-gray-50 p-6 rounded-lg shadow-md max-h-[70vh] overflow-y-auto">
            <div className="text-2xl font-bold text-green-600 mb-4">Score: {data?.data?.score || 0}</div>

            <h4 className="text-lg font-medium text-gray-800 mb-2">Issues:</h4>
            <ul className="space-y-4">
              {data?.data?.issues?.map((issue: IIssue, index: string) => (
                <li key={index} className="p-4 bg-yellow-100 border-l-4 border-yellow-500 rounded-lg">
                  <div className="font-semibold text-gray-800">Rule: {issue.rule}</div>
                  <div className="text-gray-700 mt-2">
                    <strong>Details: </strong>{issue.details}
                  </div>

                  <div className="mt-4 p-4 bg-green-100 border-l-4 border-green-500 rounded-lg">
                    <strong>Suggested Fix:</strong> {issue.suggested_fix.message}
                    <br />
                    <strong>Example Fix:</strong> <code className="bg-gray-200 p-1 rounded-md">{issue.suggested_fix.example_fix}</code>
                  </div>
                </li>
              ))}
            </ul>
          </div>

          {/* Restart button */}
          <div className="mt-6 text-center">
            <button
              onClick={handleRestart}
              className="w-full p-3 text-white bg-gray-600 rounded-md hover:bg-gray-700"
            >
              Restart
            </button>
          </div>
        </div>
      )}
    </div>
  );
};

export default FileUpload;
