import { HttpInterceptorFn } from "@angular/common/http";
import { inject } from "@angular/core";
import { AuthService } from "@shared/services/auth.service";

export const setAuthTokenInterceptorInterceptor: HttpInterceptorFn = (req, next) => {
  const authService = inject(AuthService);
  const authToken = authService.authToken();

  if (authService) {
    const newRequest = req.clone();
    newRequest.headers.set("Authorization", `Bearer ${authToken}`);
    return next(newRequest);
  }

  return next(req);
};
