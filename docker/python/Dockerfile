FROM python:3.11-slim

# Minimal dependencies for pip
RUN apt-get update && apt-get install -y --no-install-recommends \
    curl \
    git \
    libffi-dev \
    libssl-dev \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# Install Python dependencies
COPY ./docker/python/requirements.txt ./requirements.txt

RUN pip install --no-cache-dir --upgrade pip setuptools wheel \
    && pip install --no-cache-dir --prefer-binary -r requirements.txt

# Copy ML API source code
COPY ./ml/ .

EXPOSE 8001

CMD ["uvicorn", "ml_api:app", "--host", "0.0.0.0", "--port", "8001"]