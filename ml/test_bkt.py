import time
import pandas as pd
from pyBKT.models import Model

df = pd.DataFrame({
    "user_id": [1, 1, 1, 1, 1],
    "skill_name": ["skill1"] * 5,
    "correct": [1, 0, 1, 1, 0],
    "order_id": [1, 2, 3, 4, 5],
})

print("Creating model...", flush=True)

model = Model(
    seed=42,
    num_fits=1,
)

print("Starting fit...", flush=True)

start = time.perf_counter()

model.fit(
    data=df,
    forgets=True,
    defaults={
        "prior": 0.3,
        "guess": 0.25,
        "slip": 0.1,
    },
)

print(
    f"Finished in {time.perf_counter() - start:.2f}s",
    flush=True,
)

print(model.params())