interface IServerResponse<T = unknown> {
  success: boolean;
  message: string;
  errors?: [];
  data: T;
}

interface IAnalysisResponse {
  score: number;
  issues: array;
}