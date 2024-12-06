import { analyzerApi } from ".";

export const getAnalysis = analyzerApi.injectEndpoints({
  endpoints: (build) => ({
    getAnalysis: build.mutation<
    IServerResponse<IAnalysisResponse>,
    { file: FormData }
    >({
      query: ({ file }) => ({
        url: "/accessibilty/analyze",
        method: "POST",
        data: file,
      }),
      invalidatesTags: ["Analysis"],
    }),
  }),
});

export const { useGetAnalysisMutation } = getAnalysis;
