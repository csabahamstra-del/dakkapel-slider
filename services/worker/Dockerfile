# Build from the repository root:  docker build -f services/worker/Dockerfile -t veryo-worker .
FROM node:22-slim
ENV PNPM_HOME=/pnpm PATH=/pnpm:$PATH NODE_ENV=production
RUN corepack enable
WORKDIR /app

COPY pnpm-lock.yaml pnpm-workspace.yaml package.json tsconfig.base.json ./
COPY packages/core/package.json packages/core/
COPY services/worker/package.json services/worker/
RUN pnpm install --frozen-lockfile --prod --filter @veryo/worker...

COPY packages/core/src packages/core/src
COPY services/worker/src services/worker/src

USER node
WORKDIR /app/services/worker
CMD ["node", "--import", "tsx", "src/main.ts"]
