export interface ISuggestedFix {
  message: string;
  example_fix: string;
}

export interface IIssue {
  rule: string;
  details: string;
  suggested_fix: ISuggestedFix;
}