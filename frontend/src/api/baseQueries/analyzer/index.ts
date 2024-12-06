// import config from "@/config";
import { axiosBaseQuery } from "@/api/interceptor/axiosBaseQuery";
import { createApi } from "@reduxjs/toolkit/query/react";

export const analyzerApi = createApi({
  // baseQuery: axiosBaseQuery({ baseUrl: `${config.API_URL!}` }),
  // baseQuery: axiosBaseQuery({ baseUrl: 'http://app-backend:8000/api/v1' }),
  baseQuery: axiosBaseQuery({ baseUrl: 'http://localhost:8000/api/v1' }),
  endpoints: () => ({}),
  reducerPath: "analyzerApi",
  keepUnusedDataFor: 30,
  tagTypes: ["Analysis"],
});
