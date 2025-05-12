FROM node:16 as build-stage
WORKDIR /app
RUN npm config set strict-ssl false
COPY package*.json ./
RUN npm install
RUN npx update-browserslist-db@latest --no-update-notifier --no-fund
COPY ./ .
RUN npm run build

FROM nginx as production-stage

EXPOSE 3000

RUN mkdir /app
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=build-stage /app/dist /app