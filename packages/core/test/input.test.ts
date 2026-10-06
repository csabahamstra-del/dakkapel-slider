import { describe, expect, it } from "vitest";
import { buildContentBlocks, detectFileKind } from "../src/index.js";

const bytes = (s: string) => new TextEncoder().encode(s);

describe("detectFileKind", () => {
  it.each([
    [{ filename: "rapport.PDF" }, "pdf"],
    [{ filename: "x", mimeType: "application/pdf" }, "pdf"],
    [{ filename: "dienst.docx" }, "docx"],
    [{ filename: "dienst.doc" }, "doc"],
    [{ filename: "body.txt" }, "text"],
    [{ filename: "foto.jpg", mimeType: "image/jpeg" }, "unsupported"],
  ] as const)("%o → %s", (file, kind) => {
    expect(detectFileKind(file)).toBe(kind);
  });
});

describe("buildContentBlocks", () => {
  it("turns PDFs into document blocks and text into text blocks", async () => {
    const { blocks, skipped } = await buildContentBlocks({
      subject: "Dienstrapport",
      receivedAt: "2026-03-13T07:00:00Z",
      bodyText: "Zie bijlage.",
      files: [
        { filename: "a.pdf", data: bytes("%PDF-1.4") },
        { filename: "b.txt", data: bytes("Ronde 23:00 geen bijzonderheden") },
      ],
    });
    expect(skipped).toEqual([]);
    expect(blocks.map((b) => b.type)).toEqual(["document", "text", "text"]);
    expect(blocks[1]).toMatchObject({ text: expect.stringContaining("Ronde 23:00") });
    expect(blocks[2]).toMatchObject({
      text: expect.stringContaining("Ontvangen op: 2026-03-13T07:00:00Z"),
    });
  });

  it("skips unsupported and unreadable files with a reason", async () => {
    const { blocks, skipped } = await buildContentBlocks({
      files: [
        { filename: "oud.doc", data: bytes("x") },
        { filename: "kapot.docx", data: bytes("geen zip") },
        { filename: "foto.jpg", mimeType: "image/jpeg", data: bytes("x") },
      ],
    });
    expect(blocks).toEqual([]);
    expect(skipped.map((s) => s.filename)).toEqual(["oud.doc", "kapot.docx", "foto.jpg"]);
  });
});
